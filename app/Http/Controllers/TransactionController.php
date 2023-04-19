<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Credit;
use App\Models\Credit_detail;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Stock_transaction;
use App\Models\Supplier;
use App\Models\Stock;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use PDF;
use App\Traits\Terbilang;

class TransactionController extends Controller
{
    use Terbilang;
    
    public function history(Request $request) {
        $months  = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );
        $now            = Carbon::now()->format('Y-m-d');
        $user_branch_id = Auth::user()->branch_id;
        $filter         = $request->filter;
        $branch         = $request->branch;
        $date_selected  = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected  = $request->year_selected;
        $date_start     = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end       = Carbon::parse($request->date_end)->format('Y-m-d');

        if(Auth::user()->role == 'Owner') {
            $branches = Branch::get();
            $transaction = DB::table('orders')
                                ->select([
                                    'orders.*',
                                    'branches.name as branch',
                                    'customers.name as customer_name',
                                    'customers.company as customer_company',
                                    'users.name as user_name'
                                ])
                                ->join('branches','orders.branch_id','=','branches.id')
                                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                                ->join('users', 'customers.user_id', '=', 'users.id')
                                ->orderBy('orders.created_at')
                                ->where('orders.status', '<>', 'draft');
        } else {
            $branches = Branch::where('id', $user_branch_id)->get();
            $transaction = DB::table('orders')
                                ->select([
                                    'orders.*',
                                    'branches.name as branch',
                                    'customers.name as customer_name',
                                    'customers.company as customer_company',
                                    'users.name as user_name'
                                ])
                                ->join('branches','orders.branch_id','=','branches.id')
                                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                                ->join('users', 'customers.user_id', '=', 'users.id')
                                ->orderBy('orders.created_at')
                                ->where([
                                    ['orders.status', '<>', 'draft'],
                                    ['orders.branch_id', $user_branch_id]
                                ]);
        }

        if($branch == Null) {
            $transaction = $transaction;
        } else {
            $transaction = $transaction->where('orders.branch_id', $branch);
        }

        // if($filter == Null) {
        //     $transaction = $transaction->where(DB::raw('substr(orders.updated_at,1,10)'), now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();

        //     $date = now()->today()->format('d M Y');
        // }

        // if($filter == 'Hari Ini') {
        //     $transaction = $transaction->where(DB::raw('substr(orders.updated_at,1,10)'), now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();

        //     $date = now()->today()->format('d M Y');
        // }

        // if($filter == 'Minggu Ini') {
        //     $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        //     $endOfWeek   = now()->endOfWeek()->format('Y-m-d');
        //     $transaction = $transaction->whereBetween(DB::raw('substr(orders.updated_at,1,10)'), [$startOfWeek, $endOfWeek])->paginate(10)->withQueryString();

        //     $startWeek = now()->startOfWeek()->format('d M Y');
        //     $endWeek   = now()->endOfWeek()->format('d M Y');
        //     $date      = $startWeek.' sampai '.$endWeek;
        // }

        // if($filter == 'Bulan Ini') {
        //     $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        //     $endOfMonth   = now()->endOfMonth()->format('Y-m-d');
        //     $transaction  = $transaction->whereBetween(DB::raw('substr(orders.updated_at,1,10)'), [$startOfMonth, $endOfMonth])->paginate(10)->withQueryString();

        //     $startMonth = now()->startOfMonth()->format('d M Y');
        //     $endMonth   = now()->endOfMonth()->format('d M Y');
        //     $date       = $startMonth.' sampai '.$endMonth;
        // }

        // if($filter == 'Hari Kemarin') {
        //     $transaction = $transaction->where(DB::raw('substr(orders.updated_at,1,10)'), now()->yesterday()->format('Y-m-d'))->paginate(10)->withQueryString();

        //     $date = now()->yesterday()->format('d M Y');
        // }

        // if($filter == 'Minggu Kemarin') {
        //     $startOfWeek = now()->subWeek()->startOfWeek()->format('Y-m-d');
        //     $endOfWeek   = now()->subWeek()->endOfWeek()->format('Y-m-d');
        //     $transaction = $transaction->whereBetween(DB::raw('substr(orders.updated_at,1,10)'), [$startOfWeek, $endOfWeek])->paginate(10)->withQueryString();

        //     $startWeek = now()->subWeek()->startOfWeek()->format('d M Y');
        //     $endWeek   = now()->subWeek()->endOfWeek()->format('d M Y');
        //     $date      = $startWeek.' sampai '.$endWeek;
        // }

        // if($filter == 'Bulan Kemarin') {
        //     $startOfMonth = now()->subMonth()->startOfMonth()->format('Y-m-d');
        //     $endOfMonth   = now()->subMonth()->endOfMonth()->format('Y-m-d');
        //     $transaction  = $transaction->whereBetween(DB::raw('substr(orders.updated_at,1,10)'), [$startOfMonth, $endOfMonth])->paginate(10)->withQueryString();


        //     $startMonth = now()->subMonth()->startOfMonth()->format('d M Y');
        //     $endMonth   = now()->subMonth()->endOfMonth()->format('d M Y');
        //     $date       = $startMonth.' sampai '.$endMonth;
        // }

        if($filter == 'Hari Ini' || $filter == Null) {
            $transaction = $transaction->where('orders.date', now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();
            $date = 'Tanggal '.now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $transaction = $transaction->where('orders.date', $date_selected)->paginate(10)->withQueryString();
            $date = 'Tanggal '.date('d M Y', strtotime($date_selected));
        }

        if($filter == 'Bulan') {
            $transaction = $transaction->where(DB::raw('substr(orders.date,1,7)'), $month_selected)->paginate(10)->withQueryString();
            $date = 'Bulan '.$month_selected;
        }

        if($filter == 'Tahun') {
            $transaction = $transaction->where(DB::raw('substr(orders.date,1,4)'), $year_selected)->paginate(10)->withQueryString();
            $date = 'Tahun '.$year_selected;
        }

        if($filter == 'custom') {
            $transaction = $transaction->whereBetween('orders.date', [$date_start, $date_end])->paginate(10)->withQueryString();

            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        return view('pages.transaction.history', compact('months','branches','transaction','filter','date','date_start','date_end'));
    }

    public function detail($id) {
        $details = Order_detail::select(
                                'order_details.*',
                                'orders.date',
                                'orders.invoice',
                                'orders.disc as total_disc',
                                'orders.ppn as total_ppn',
                                'orders.grandtotal',
                                'orders.delivery',
                                'orders.payment_method',
                                'products.code as product_code',
                                'products.name as product_name',
                                'customers.name as customer_name',
                                'customers.name as customer_company',
                                'users.name as user_name'
                            )
                            ->join('orders', 'order_details.order_id', '=', 'orders.id')
                            ->join('products', 'order_details.product_id', '=', 'products.id')
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('users', 'customers.user_id', '=', 'users.id')
                            ->where('orders.id', $id)
                            ->orderBy('order_details.created_at')
                            ->get();
        
        return view('pages.transaction.detail_history', compact('details'));
    }

    public function return($id) {
        $details = Order_detail::select(
            'order_details.*',
            'orders.updated_at',
            'orders.invoice',
            'orders.disc as total_disc',
            'orders.ppn as total_ppn',
            'orders.grandtotal',
            'orders.delivery',
            'orders.payment_method',
            'products.code as product_code',
            'products.name as product_name',
            'customers.name as customer_name',
            'users.name as user_name'
        )
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('users', 'customers.user_id', '=', 'users.id')
        ->where('orders.id', $id)
        ->orderBy('order_details.created_at')
        ->get();

        return view('pages.transaction.return', compact('details'));
    }

    public function returnStore(Request $request, $id) {
        $order_old        = Order::find($id);
        $user_id          = Auth::user()->id;
        $user_branch_id   = Auth::user()->branch_id;
        $now              = Carbon::now()->format('Y-m');

        $getInvoice = DB::table('orders')
                    ->select(DB::raw('max(invoice) as maxInv'))
                    ->where([
                        [DB::raw('substr(updated_at,1,7)'), $now],
                        ['branch_id', $user_branch_id],
                        ['status', 'return']
                    ])
                    ->first();
        $lastInv = $getInvoice->maxInv;
        $no = (int) substr($lastInv,8,3);
        $no++;
        $invoice = 'FR'.date('y').'-'.date('m').'-'.sprintf('%03s', $no);

        $order = new Order();
        $order->invoice     = $invoice;
        $order->customer_id = $order_old->customer_id;
        $order->status      = 'return';
        $order->user_id     = $user_id;
        $order->salesman_id = $order_old->salesman_id;
        $order->branch_id   = $user_branch_id;
        $order->return      = $order_old->invoice;
        $order->date        = date('Y-m-d');
        $order->save();

        foreach($request->addProduct as $i => $product) {
            if($product['return'] > 0) {
                $product_old = Order_detail::where('id', $product['order_detail_id'])->first();
                $new_qty = $product_old->qty - $product['return'];

                Order_detail::where('id', $product['order_detail_id'])
                ->update([
                    'qty' => $new_qty,
                    'total' => (($new_qty * $product_old->price) - ((($new_qty * $product_old->price)*$product_old->disc)/100))
                ]);

                $return = new Order_detail();
                $return->order_id = $order->id;
                $return->product_id = $product['product_id'];
                $return->qty = $product['return'];
                $return->status = 'return';
                $return->save();

                $qty_stock_old = Stock::where([
                    ['branch_id', $order_old->branch_id],
                    ['product_id', $product['product_id']]
                ])->first();

                Stock::where([
                    ['branch_id', $order_old->branch_id],
                    ['product_id', $product['product_id']]
                ])->update([
                    'qty' => $qty_stock_old->qty + $product['return']
                ]);
            }
        }

        $order_detail = Order_detail::where('order_id', $id)->get();
            
        $order_old->subtotal = $order_detail->sum('total');
        $order_old->disc     = $order_detail->sum('disc');
        $order_old->grandtotal = $order_detail->sum('total') + $order_old->delivery;
        $order_old->save();

        return redirect()->back()->with('success', 'Data berhasil diretur');
    }

    public function print($id) {
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
                'customers.phone',
                'customers.city',
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

    public function credit(Request $request) {
        // $months  = array(
        //     "01" => "Januari",
        //     "02" => "Februari",
        //     "03" => "Maret",
        //     "04" => "April",
        //     "05" => "Mei",
        //     "06" => "Juni",
        //     "07" => "Juli",
        //     "08" => "Agustus",
        //     "09" => "September",
        //     "10" => "Oktober",
        //     "11" => "November",
        //     "12" => "Desember"
        // );
        // $now            = Carbon::now()->format('Y-m-d');
        // $user_branch_id = Auth::user()->branch_id;
        // $filter         = $request->filter;
        $branch         = $request->branch;
        // $date_selected  = $request->date_selected;
        // $month_selected = date('Y').'-'.$request->month_selected;
        // $year_selected  = $request->year_selected;
        // $date_start     = Carbon::parse($request->date_start)->format('Y-m-d');
        // $date_end       = Carbon::parse($request->date_end)->format('Y-m-d');

        if(Auth::user()->role == 'Owner') {
            $branches = Branch::get();
            $transaction = DB::table('orders')
                                ->select([
                                    'orders.*',
                                    'branches.name as branch',
                                    'customers.name as customer_name',
                                    'customers.company as customer_company',
                                    DB::raw('count(orders.id) as total_credit_transaction'),
                                    DB::raw('sum(credits.remaining) as total_remaining')
                                ])
                                ->join('branches','orders.branch_id','=','branches.id')
                                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                                ->join('credits', 'orders.id', '=', 'credits.order_id')
                                ->orderBy('customers.company')
                                ->groupBy('orders.customer_id')
                                ->where([
                                    ['orders.status', 'print']
                                ]);
        } else {
            $branches = Branch::where('id', $user_branch_id)->get();
            $transaction = DB::table('orders')
                                ->select([
                                    'orders.*',
                                    'branches.name as branch',
                                    'customers.name as customer_name',
                                    'customers.company as customer_company',
                                    DB::raw('count(orders.id) as total_credit_transaction'),
                                    DB::raw('sum(credits.remaining) as total_remaining')
                                ])
                                ->join('branches','orders.branch_id','=','branches.id')
                                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                                ->join('credits', 'orders.id', '=', 'credits.order_id')
                                ->orderBy('customers.company')
                                ->groupBy('orders.customer_id')
                                ->where([
                                    ['orders.status', 'print'],
                                    ['orders.branch_id', $user_branch_id]
                                ]);
        }

        if($branch == Null) {
            $transaction = $transaction->paginate(10)->withQueryString();
        } else {
            $transaction = $transaction->where('orders.branch_id', $branch)->paginate(10)->withQueryString();
        }

        // if($filter == Null) {
        //     $transaction = $transaction->where('orders.date', now()->today()->format('Y-m-d'))->get();

        //     $date = now()->today()->format('d M Y');
        // }

        // if($filter == 'Hari Ini') {
        //     $transaction = $transaction->where('orders.date', now()->today()->format('Y-m-d'))->get();

        //     $date = now()->today()->format('d M Y');
        // }

        // if($filter == 'Minggu Ini') {
        //     $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        //     $endOfWeek   = now()->endOfWeek()->format('Y-m-d');
        //     $transaction = $transaction->whereBetween('orders.date', [$startOfWeek, $endOfWeek])->get();

        //     $startWeek = now()->startOfWeek()->format('d M Y');
        //     $endWeek   = now()->endOfWeek()->format('d M Y');
        //     $date      = $startWeek.' sampai '.$endWeek;
        // }

        // if($filter == 'Bulan Ini') {
        //     $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        //     $endOfMonth   = now()->endOfMonth()->format('Y-m-d');
        //     $transaction  = $transaction->whereBetween('orders.date', [$startOfMonth, $endOfMonth])->get();

        //     $startMonth = now()->startOfMonth()->format('d M Y');
        //     $endMonth   = now()->endOfMonth()->format('d M Y');
        //     $date       = $startMonth.' sampai '.$endMonth;
        // }

        // if($filter == 'Hari Kemarin') {
        //     $transaction = $transaction->where('orders.date', now()->yesterday()->format('Y-m-d'))->get();

        //     $date = now()->yesterday()->format('d M Y');
        // }

        // if($filter == 'Minggu Kemarin') {
        //     $startOfWeek = now()->subWeek()->startOfWeek()->format('Y-m-d');
        //     $endOfWeek   = now()->subWeek()->endOfWeek()->format('Y-m-d');
        //     $transaction = $transaction->whereBetween('orders.date', [$startOfWeek, $endOfWeek])->get();

        //     $startWeek = now()->subWeek()->startOfWeek()->format('d M Y');
        //     $endWeek   = now()->subWeek()->endOfWeek()->format('d M Y');
        //     $date      = $startWeek.' sampai '.$endWeek;
        // }

        // if($filter == 'Bulan Kemarin') {
        //     $startOfMonth = now()->subMonth()->startOfMonth()->format('Y-m-d');
        //     $endOfMonth   = now()->subMonth()->endOfMonth()->format('Y-m-d');
        //     $transaction  = $transaction->whereBetween('orders.date', [$startOfMonth, $endOfMonth])->get();


        //     $startMonth = now()->subMonth()->startOfMonth()->format('d M Y');
        //     $endMonth   = now()->subMonth()->endOfMonth()->format('d M Y');
        //     $date       = $startMonth.' sampai '.$endMonth;
        // }

        // if($filter == 'Hari Ini' || $filter == Null) {
        //     $transaction = $transaction->where('orders.date', now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();
        //     $date = 'Tanggal '.now()->today()->format('d M Y');
        // }

        // if($filter == 'Tanggal') {
        //     $transaction = $transaction->where('orders.date', $date_selected)->paginate(10)->withQueryString();
        //     $date = 'Tanggal '.now()->today()->format('d M Y');
        // }

        // if($filter == 'Bulan') {
        //     $transaction = $transaction->where(DB::raw('substr(orders.date,1,7)'), $month_selected)->paginate(10)->withQueryString();
        //     $date = 'Bulan '.$month_selected;
        // }

        // if($filter == 'Tahun') {
        //     $transaction = $transaction->where(DB::raw('substr(orders.date,1,4)'), $year_selected)->paginate(10)->withQueryString();
        //     $date = 'Tahun '.$year_selected;
        // }

        // if($filter == 'custom') {
        //     $transaction = $transaction->whereBetween('orders.date', [$date_start, $date_end])->get();

        //     $startDate = Carbon::parse($request->date_start)->format('d M Y');
        //     $endDate   = Carbon::parse($request->date_end)->format('d M Y');
        //     $date      = $startDate.' sampai '.$endDate;
        // }

        return view('pages.transaction.credit', compact('branches','transaction'));
    }

    public function detailCredit($id) {
        $details = Order::select(
                                'orders.updated_at',
                                'orders.invoice',
                                'orders.grandtotal',
                                'orders.due',
                                'customers.company as customer_company',
                                'customers.name as customer_name',
                                'customers.address as customer_address',
                                'customers.city as customer_city',
                                'customers.phone as customer_phone',
                                'salesmen.name as salesman',
                                'credits.remaining',
                                'credits.id'
                            )
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('salesmen', 'orders.salesman_id', '=', 'salesmen.id')
                            ->join('credits','orders.id','=','credits.order_id')
                            ->where([
                                ['orders.customer_id',$id],
                                ['orders.status','print']
                            ])
                            ->get();
        
        return view('pages.transaction.detail_credit', compact('details'));
    }

    public function payCredit($id) {
        $credit = DB::table('credits')
                        ->select(
                            'orders.invoice',
                            'credits.id',
                            'credits.remaining'
                        )
                        ->join('orders','credits.order_id','=','orders.id')
                        ->where('credits.id',$id)
                        ->first();
        
        return view('pages.transaction.pay_credit', compact('credit'));
    }

    public function paymentCredit(Request $request, $id) {
        $credit = Credit::find($id);
        $latestTerm = $credit->credit_detail->max('term');
        Credit_detail::create([
            'credit_id' => $credit->id,
            'nominal'   => str_replace('.', '', $request->nominal),
            'term'      => $latestTerm + 1
        ]);
        $credit->remaining = $credit->remaining - str_replace('.', '', $request->nominal);
        if($credit->remaining == 0) {
            $credit->status = 'Lunas';
        }
        $credit->save();

        if($credit->status == 'Lunas') {
            $order = Order::find($credit->order_id);
            $order->payment_method = 'cash';
            $order->save();
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function detailPaymentCredit($id) {
        $details = Credit_detail::where('credit_id', $id)->get();
        $order_detail = Order_detail::where('order_id', $details[0]->credit->order_id)->get();

        return view('pages.transaction.detail_payment_credit', compact('details','order_detail'));
    }

    public function debtList(Request $request) {
        $suppliers = Supplier::get();
        $supplier  = $request->filter;
        $debts     = Stock_transaction::select(
                                'suppliers.id',
                                'suppliers.name as supplier',
                                'branches.name as branch',
                                DB::raw('sum(remaining) as total_debt')
                            )          
                            ->join('branches','stock_transactions.branch_id','=','branches.id')
                            ->join('suppliers','stock_transactions.supplier_id','=','suppliers.id')
                            ->groupBy('stock_transactions.supplier_id')
                            ->where('stock_transactions.type', 'in');
        
        if($supplier == null) {
            $debts = $debts->paginate(10)->withQueryString();
        } else {
            $debts = $debts->where('stock_transactions.supplier_id', $supplier)->paginate(10)->withQueryString();
        }

        return view('pages.transaction.debt', compact('suppliers','debts'));
    }

    public function debtDetail($id) {
        $detail = DB::table('stock_transactions')
                        ->select(
                            'stock_transactions.id',
                            'stock_transactions.invoice',
                            'stock_transactions.subtotal',
                            'stock_transactions.remaining',
                            'stock_transactions.date',
                            'suppliers.name as supplier'
                        )
                        ->join('suppliers','stock_transactions.supplier_id','=','suppliers.id')
                        ->where([
                            ['stock_transactions.supplier_id',$id],
                            ['stock_transactions.remaining','>',0]
                        ])
                        ->get();
            
        return view('pages.transaction.detail_debt', compact('detail'));
    }

    public function debtPay($id) {
        $debt = Stock_transaction::find($id);
        $debt->remaining = 0;
        $debt->save();

        return redirect()->back()->with('success','Hutang dilunasi');
    }
}
