<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use App\Models\Credit;
use App\Models\Credit_detail;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Traits\Terbilang;
use DB;
use PDF;

class SellingController extends Controller
{
    use Terbilang;

    public function selling() {
        return view('pages.transaction.selling');
    }

    public function getCustomerList() {
        $user_branch_id = Auth::user()->branch_id;
        $customers = Customer::select('customers.*')
                            ->join('users', 'customers.user_id', '=', 'users.id')
                            ->where('users.branch_id', $user_branch_id)
                            ->orderBy('customers.company')
                            ->get();

        return response()->json(['customerList' => $customers]);
    }

    public function getStockList() {
        if(Auth::user()->role == 'Owner') {
            $stock = Stock::select('stocks.id', 'stocks.qty', 'products.id as product_id', 'products.name as product_name')
                    ->join('products', 'stocks.product_id', '=', 'products.id')
                    ->orderBy('products.code')
                    ->get();
        } else {
            $stock = Stock::select('stocks.id', 'stocks.qty', 'products.id as product_id', 'products.name as product_name')
                    ->join('products', 'stocks.product_id', '=', 'products.id')
                    ->where('branch_id', Auth::user()->branch_id)
                    ->orderBy('products.code')
                    ->get();
        }

        return response()->json(['stockList' => $stock]);
        
    }

    public function findOrderById($id) {
        $order = Order::select('orders.*', 'customers.company as customer_company')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->find($id);

        return response()->json([
                'order' => $order
            ]
        );
    }

    public function addOrderInfo(Request $request) {
        if(empty($request->customer_id)) {
            return response()->json([
                'success'   => false,
                'errorList' => [
                    'customer_id' => 'Tidak boleh kosong.'
                ]
            ]);
        }

        $check = Customer::find($request->customer_id);
        if(isset($check)) {
            $branch_id  = Auth::user()->branch_id;
            $user_id    = Auth::user()->id;
            $now        = Carbon::now()->format('Y-m');
            $getInvoice = DB::table('orders')
                        ->select(DB::raw('max(invoice) as maxInv'))
                        ->where([
                            [DB::raw('substr(updated_at,1,7)'), $now],
                            ['branch_id', $branch_id],
                            ['status', 'print']
                        ])
                        ->first();
            $lastInv = $getInvoice->maxInv;
            $no      = (int) substr($lastInv,8,3);
            $no++;
            $invoice = 'FJ'.date('y').'-'.date('m').'-'.sprintf('%03s', $no);
            $order   = Order::create([
                'customer_id' => $request->customer_id,
                'branch_id'   => $branch_id,
                'user_id'     => $user_id,
                'invoice'     => $invoice
            ]);
            
            return response()->json([
                'order' => $order
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'errorList' => [
                    'customer_id' => 'Customer tidak ada di database.'
                ]
            ]);
        }
    }

    public function addOrderList(Request $request, $id) {
        if(empty($request->product_id)) {
            return response()->json([
                'success'   => false,
                'errorList' => ['product' => 'Tidak boleh kosong.']
            ]);
        }

        $countOD = Order_detail::where("order_id",$id)->count();
        if($countOD < 12){
            $branch_id      = Auth::user()->branch_id;
            $customer_id    = $request->customer_id;
            $product_id     = $request->product_id;
            $qty            = $request->qty;
            $checkPricelist = Pricelist::where([
                                            ['product_id', $product_id],
                                            ['customer_id', $customer_id],
                                            ['branch_id', $branch_id]
                                        ])->first();
            if(empty($checkPricelist)) {
                $product = Pricelist::select('price')
                                        ->where([
                                            ['product_id', $product_id],
                                            ['branch_id', $branch_id],
                                            ['customer_id', Null]
                                        ])->first();

                if(empty($product)) {
                    return response()->json([
                        'success'   => false,
                        'errorList' => ['pricelist' => 'Produk belum ditentukan harganya di Daftar Harga.']
                    ]);
                }

                $price = $product->price;
                $total = $price * $qty;
            } else {
                $product = Pricelist::select('price')
                                        ->where([
                                            ['product_id', $product_id],
                                            ['branch_id', $branch_id],
                                            ['customer_id', $customer_id]
                                        ])->first();

                $price = $product->price;
                $total = $price * $qty;
            }

            $stock = DB::table('stocks')
                            ->select('stocks.qty as qty', 'products.name as name', 'products.unit as unit')
                            ->join('products', 'stocks.product_id', '=', 'products.id')
                            ->where([
                                ['stocks.product_id', $request->product_id],
                                ['stocks.branch_id', $branch_id]
                            ])
                            ->first();
            
            $cek   = Order_detail::where([
                                ['order_id', $id],
                                ['product_id', $request->product_id]
                            ])->get();

            if($cek->isEmpty()) {
                $new_stock = $stock->qty - $request->qty;
            } else {
                $qty_order = DB::table('order_details')
                                ->select('order_details.qty as qty')
                                ->join('products', 'order_details.product_id', '=', 'products.id')
                                ->where([
                                    ['order_details.product_id', $request->product_id],
                                    ['order_details.order_id', $id]
                                ])
                                ->first();

                $new_stock = $stock->qty - $request->qty - $qty_order->qty;
            }

            if($new_stock < 0) {
                return response()->json([
                    'success'   => false,
                    'errorList' => [
                        'stock' => 'Stok '.$stock->name.' tersedia '.$stock->qty.' '.$stock->unit.'.'
                    ]
                ]);
            } else {
                $order_detail = Order_detail::create([
                    'order_id'   => $id,
                    'product_id' => $product_id,
                    'price'      => $price,
                    'qty'        => $qty,
                    'disc'       => 0,
                    'ppn'        => 0,
                    'total'      => $total
                ]);
            }
            
            return response()->json([
                'data' => $order_detail
            ]);
        } else{
            return response()->json([
                'success'   => false,
                'errorList' => ['count' => 'Jumlah item maksimal 10']
            ]);
        }
        
    }

    public function getOrderList($id) {
        $orderList = DB::table('order_details')
                        ->select('order_details.*','products.name as product_name','products.unit as product_unit')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->where('orders.id', $id)
                        ->orderBy('order_details.created_at')
                        ->get();

        return response()->json([
            'orderList' => $orderList
        ]);
    }

    public function updateOrderList(Request $request) {
        if($request->qty <= 0) {
            return response()->json([
                'success'   => false,
                'errorList' => ['qty' => 'Tidak boleh kosong.']
            ]);
        }
        // $price = Pricelist::select('price')->where('product_id', $request->product_id)->first();
        

        $order_detail = Order_detail::find($request->id);
        $total = ($order_detail->price * $request->qty);
        $afterDisc = $total - (($total * $request->disc) / 100);
        $order_detail->qty   = $request->qty;
        $order_detail->disc  = $request->disc;
        $order_detail->total = $afterDisc;
        if(!empty($request->get('ppn'))) {
            $order_detail->ppn = ($afterDisc * 11) / 100;
        }
        $order_detail->save();

        return response()->json([
            'result' => $order_detail
        ]);
    }

    public function getSubtotal($id) {
        $subtotal = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.id', $id)
            ->sum('order_details.total');

        return response()->json([
            'subtotal' => $subtotal
        ]);
    }

    public function getDisc($id) {
        $total_disc = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.id', $id)
            ->sum('order_details.disc');

        return response()->json([
            'total_disc' => $total_disc
        ]);
    }

    public function getPpn($id) {
        $total_ppn = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.id', $id)
            ->sum('order_details.ppn');
        
        return response()->json([
            'total_ppn' => $total_ppn
        ]);
    }

    public function removeOrderList(Request $request) {
        Order_detail::find($request->id)->forceDelete();

        return response()->json();
    }

    public function removeOrder($id) {
        Order::find($id)->delete();

        return response()->json();
    }   

    public function print(Request $request, $id) {
        $check = Order::where([
            ['id', $id],
            ['status', 'print']
        ])->get();
        // $order_detail   = Order_detail::where('order_id', $id)->get();
        // $subtotal       = $order_detail->sum('total');
        // $disc           = $order_detail->sum('disc');
        // $ppn            = $order_detail->sum('ppn');
        $order_detail   = Order_detail::select(
            DB::raw('sum(total) as total_total'),
            DB::raw('sum(ppn) as total_ppn'),
            DB::raw('sum(disc) as total_disc')
        )
        ->groupBy('order_id')
        ->where('order_id', $id)
        ->first();
        $subtotal       = $order_detail->total_total;
        $disc           = $order_detail->total_disc;
        $ppn            = $order_detail->total_ppn;
        $delivery       = $request->delivery;
        $grandtotal     = $subtotal + $delivery;
        $payment        = $request->payment;
        $payment_method = $request->payment_method;
        $user_id        = Auth::user()->id;
        $user_branch_id = Auth::user()->branch_id;
        $customer_id    = Order::select('customer_id')->where('id', $id)->first();
        $tenor          = Customer::select('tenor')->where('id', $customer_id->customer_id)->first();
        $salesman_id    = Customer::select('salesman_id')->where('id', $customer_id->customer_id)->first();

        if($check->isEmpty()) {
            $validate = \Validator::make($request->all(), [
                'payment_method' => 'required'
            ]);

            if( $validate->fails() ) {
                return response()->json([
                    'success'   => false,
                    'errorList' => [
                        'payment_method' => 'Metode Pembayaran belum dipilih.'
                    ]
                ]);
            }

            if($payment_method == 'cash') {
                if($payment < $grandtotal) {
                    return response()->json([
                        'success'   => false,
                        'errorList' => ['payment' => 'Nominal kurang.']
                    ]);
                }
            }
            
            if($payment_method == 'credit') {
                $change = $grandtotal-$payment;
                $credit = new Credit();
                $credit->order_id  = $id;
                $credit->nominal   = $grandtotal;
                $credit->remaining = $change;
                $credit->due       = Carbon::now()->addMonths($tenor->tenor);
                $credit->tenor     = $tenor->tenor;
                $credit->save();

                Credit_detail::create([
                    'credit_id' => $credit->id,
                    'nominal'   => $payment,
                    'term'      => 1
                ]);
            }
            if(isset($request->date)){
                $date     = date('Y-m-d', strtotime($request->date));
                $due_date = date('Y-m-d', strtotime($request->date.' +1 month'));
            } else {
                $date     = Carbon::now()->format('Y-m-d');
                $due_date = Carbon::now()->addMonth($tenor->tenor);
            }
            
            $order = Order::find($id);
            $order->update([
                'subtotal'       => $subtotal,
                'disc'           => $disc,
                'ppn'            => $ppn,
                'delivery'       => $delivery,
                'grandtotal'     => $grandtotal,
                'payment'        => $payment,
                'payment_method' => $payment_method,
                'status'         => 'print',
                'due'            => $due_date,
                'user_id'        => $user_id,
                'salesman_id'    => $salesman_id->salesman_id,
                'branch_id'      => $user_branch_id,
                'date'           => $date
            ]);

            $products = Order_detail::where('order_id', $id)->get();
            foreach($products as $product) {
                $current_stock = Stock::where([
                    ['product_id', $product->product_id],
                    ['branch_id', $user_branch_id]
                ])->get();
                Stock::where([
                    ['product_id', $product->product_id],
                    ['branch_id', $user_branch_id]
                ])->update([
                    'qty' => $current_stock[0]->qty - $product->qty
                ]);
            }

            $printInvoice = DB::table('order_details')
                ->select(
                    'order_details.price',
                    'order_details.qty',
                    'order_details.disc',
                    'order_details.ppn',
                    'order_details.total',
                    'products.name as product',
                    'products.unit as unit',
                    'orders.invoice as invoice',
                    'orders.subtotal as subtotal',
                    'orders.disc as total_disc',
                    'orders.ppn as total_ppn',
                    'orders.delivery',
                    'orders.grandtotal',
                    'orders.payment',
                    'orders.payment_method',
                    'orders.date',
                    'orders.due as due_date',
                    'customers.name as customer',
                    'customers.company',
                    'customers.address',
                    'customers.city',
                    'customers.phone',
                    'salesmen.name as user',
                    'branches.name as branch',
                )
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('branches', 'orders.branch_id', '=', 'branches.id')
                ->join('salesmen', 'orders.salesman_id', '=', 'salesmen.id')
                ->where('orders.id', $id)
                ->orderBy('order_details.created_at')
                ->get();
            
            $pph = ($printInvoice[0]->subtotal*1.5) / 100;
            $terbilang = ucwords($this->pembilang($printInvoice[0]->grandtotal));
            $filename = $printInvoice[0]->invoice.'.pdf';
            $filePath =  storage_path("pdf/$filename");
            $pdf = PDF::loadView('pages.invoice.invoice_selling', ['print' => $printInvoice, 'terbilang' => $terbilang, 'pph' => $pph]);
            $pdf->setPaper('a4', 'landscape');
            $pdf->save($filePath);
            $base64TxtDto = chunk_split(base64_encode(file_get_contents($filePath)));
            unlink($filePath);

            return response()->json([
                'filename' => $base64TxtDto
            ]);
        } else {
            $order = Order::find($id);
            $printInvoice = DB::table('order_details')
                ->select(
                    'order_details.price',
                    'order_details.qty',
                    'order_details.disc',
                    'order_details.ppn',
                    'order_details.total',
                    'products.name as product',
                    'products.unit as unit',
                    'orders.invoice as invoice',
                    'orders.subtotal as subtotal',
                    'orders.disc as total_disc',
                    'orders.ppn as total_ppn',
                    'orders.delivery',
                    'orders.grandtotal',
                    'orders.payment',
                    'orders.payment_method',
                    'orders.date',
                    'orders.due as due_date',
                    'customers.name as customer',
                    'customers.company',
                    'customers.address',
                    'customers.city',
                    'customers.phone',
                    'salesmen.name as user',
                    'branches.name as branch',
                )
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('branches', 'orders.branch_id', '=', 'branches.id')
                ->join('salesmen', 'orders.salesman_id', '=', 'salesmen.id')
                ->where('orders.id', $id)
                ->orderBy('order_details.created_at')
                ->get();

            $pph = ($printInvoice[0]->subtotal*1.5) / 100;
            $terbilang = ucwords($this->pembilang($printInvoice[0]->grandtotal));
            $filename = $printInvoice[0]->invoice.'.pdf';
            $filePath =  storage_path("pdf/$filename");
            $pdf = PDF::loadView('pages.invoice.invoice_selling', ['print' => $printInvoice, 'terbilang' => $terbilang, 'pph' => $pph]);
            $pdf->setPaper('a4', 'landscape');
            $pdf->save($filePath);
            $base64TxtDto = chunk_split(base64_encode(file_get_contents($filePath)));
            unlink($filePath);

            return response()->json([
                'filename' => $base64TxtDto
            ]);
        }
    }
}
