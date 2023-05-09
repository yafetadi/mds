<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_transaction;
use App\Models\Stock_transaction_detail;
use App\Models\Supplier;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DB;

use function PHPSTORM_META\map;

class StockController extends Controller
{
    public function catalogList(Request $request) {
        $user_branch_id = Auth::user()->branch_id;
        $keyword    = $request->keyword;
        $category   = $request->category_id;
        $branch     = $request->branch_id;

        if(Auth::user()->role == 'Owner') {
            $products   = Product::orderBy('code')->get();
            $branches   = Branch::get();
            $categories = Category::orderBy('code')->get();
            $catalog    = Stock::select('stocks.*', 'products.name as product_name', 
                                        'products.code as product_code', 'products.unit as product_unit', 
                                        'categories.name as category_name', 'branches.name as branch_name')
                            ->join('products', 'stocks.product_id', '=', 'products.id')
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->when($keyword, function ($query) use ($keyword) {
                                $query->where('products.name', 'like', "%{$keyword}%")
                                ->orWhere('products.code', 'like', "%{$keyword}%");
                            })
                            ->orderBy('products.code');
                    
            if($category == Null) {
                $catalog = $catalog;
            } else {
                $catalog = $catalog->where('categories.id', $category);
            }

            if($branch == Null) {
                $catalog = $catalog->paginate(10)->withQueryString();
            } else {
                $catalog = $catalog->where('branch_id', $branch)->paginate(10)->withQueryString();
            }
        } else {
            $products   = Product::orderBy('code')->get();
            $branches   = Branch::where('id', $user_branch_id)->get();
            $categories = Category::orderBy('code')->get();
            $catalog    = Stock::select('stocks.*', 'products.name as product_name', 
                                        'products.code as product_code', 'products.unit as product_unit', 
                                        'categories.name as category_name', 'branches.name as branch_name')
                            ->join('products', 'stocks.product_id', '=', 'products.id')
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->when($keyword, function ($query) use ($keyword) {
                                $query->where('products.name', 'like', "%{$keyword}%")
                                ->orWhere('products.code', 'like', "%{$keyword}%");
                            })
                            ->where('stocks.branch_id', $user_branch_id)
                            ->orderBy('products.code');
                    
            if($category == Null) {
                $catalog = $catalog;
            } else {
                $catalog = $catalog->where('categories.id', $category);
            }

            if($branch == Null) {
                $catalog = $catalog->paginate(10)->withQueryString();
            } else {
                $catalog = $catalog->where('branch_id', $branch)->paginate(10)->withQueryString();
            }
        }
        

        return view('pages.stock.list_catalog', compact('products','branches','categories','catalog'));
    }

    public function getCatalogDetail($id) {
        $catalog  = Stock::find($id);
        $products = Product::orderBy('code')->get();

        return view('pages.stock.edit_catalog', compact('catalog','products'));    
    }

    public function detailTransactionCatalog($id) {
        $product = Stock_transaction_detail::where('stock_id', $id)->first();
        $product_name = Stock::find($id);
        $stocks = DB::table('stock_transaction_details')
                        ->select(
                            'stock_transactions.invoice',
                            'stock_transactions.date',
                            'stock_transactions.type',
                            'stock_transaction_details.qty',
                            'suppliers.name as company'
                        )
                        ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                        ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                        ->join('products', 'stocks.product_id', '=', 'products.id')
                        ->leftJoin('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                        ->where('stock_transaction_details.stock_id', $id)
                        ->get();

        $orders = DB::table('order_details')
                        ->select(
                            'orders.invoice',
                            'orders.date',
                            'orders.status',
                            'order_details.qty',
                            'customers.company'
                        )
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->join('stocks', 'products.id', '=', 'stocks.product_id')
                        ->join('customers', 'orders.customer_id', '=', 'customers.id')
                        ->where([
                            ['stocks.id', $id],
                            ['orders.status', 'print']
                        ])
                        ->get();

        //Memperbarui data order(Menambahkan hasil retur yang telah tersedia disetap invoices jika ada)
        $productId = Stock::with("product")->find($id);

        if($productId->product!=null) {
            $productId = $productId->product->id;
            $orders = $orders->map(function($e) use($productId){

                //Mendeteksi jika ada retur yang miliki referensi ke nomer invoice $e
                $returedOrder = Order::where("return",$e->invoice)->pluck("id")->first();

                if($returedOrder){
                //Mendapatkan kuantitas Retur
                $returQty = Order_detail::where("order_id",$returedOrder)->where("product_id",$productId)->pluck("qty")->first();
                
                //Mendapatkan kuantitas yg sudah ada dengan data retur
                $e->qty += $returQty;
                }
            
                return $e;
            });
        }
      
        $return = DB::table('order_details')
                        ->select(
                            'orders.invoice',
                            'orders.date',
                            'orders.status',
                            'orders.return',
                            'order_details.qty',
                            'customers.company'
                        )
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->join('stocks', 'products.id', '=', 'stocks.product_id')
                        ->join('customers', 'orders.customer_id', '=', 'customers.id')
                        ->where([
                            ['stocks.id', $id],
                            ['orders.status', 'return']
                        ])
                        ->get();
        
        $detail = $stocks->merge($orders)->merge($return)->sortBy('date');
        
        return view('pages.stock.detail_stock_transaction', compact('product','detail','product_name'));
    }

    public function catalogDelete($id) {
        $check = Stock_transaction_detail::where('stock_id', $id)->first();

        if(empty($check)) {
            $catalog = Stock::find($id);
            $catalog->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk masih ada di stok gudang.');
        }
    }

    public function catalogUpdate(Request $request, $id) {
        $check = Stock::where([
                        ['product_id', $request->product_id],
                        ['branch_id', $request->branch_id]
                    ])->first();
        if(empty($check)) {
            $stock = Stock::find($id);
            $stock->product_id = $request->product_id;
            $stock->save();

            return redirect()->back()->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Data sudah ada');
        }
    }

    public function catalogStore(Request $request) {
        $response = [];
        $response["success"] = [];
        $response["error"] = [];

        foreach($request->addCatalog as $i => $catalog) {
            $check = Stock::where([
                ['product_id', $catalog['product_id']],
                ['branch_id', $catalog['branch_id']]
            ])->with(["product","branch"])->first();
            
            if(empty($check)) {
                Stock::create([
                    'product_id' => $catalog['product_id'],
                    'qty'        => 0,
                    'branch_id'  => $catalog['branch_id'],
                    'user_id'    => Auth::user()->id
                ]);
                array_push($response["success"],"Data berhasil disimpan");
            } else {
                array_push($response["error"],"Produk ".$check->product->name." sudah ada dicabang ".$check->branch->name);
            }
        }
        
        return redirect()->back()->with('respons',json_encode($response));
    }

    public function stockInList(Request $request) {
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
        $user_branch_id = Auth::user()->branch_id;
        $suppliers  = Supplier::get(); 
        $filter     = $request->filter;
        $branch     = $request->branch;
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d'); 

        if(Auth::user()->role == 'Owner') {
            $stock_in   = DB::table('stock_transactions')
                            ->select(
                                'branches.name as branch_name',
                                'users.name as user_name',
                                'stock_transactions.*',
                                'suppliers.name as supplier'
                            )            
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                            ->leftJoin('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                            ->where('stock_transactions.type','in')
                            ->orderByDesc('invoice','date');
                            
            $catalog  = Stock::get();
            $branches = Branch::get();
            $products = Product::orderBy('code')->get();
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name', 'products.unit')
                                ->join('products', 'stocks.product_id', '=', 'products.id')
                                ->orderBy('products.code')
                                ->get();
        } else {
            $stock_in   = DB::table('stock_transactions')
                            ->select(
                                'branches.name as branch_name',
                                'users.name as user_name',
                                'stock_transactions.*',
                                'suppliers.name as supplier'
                            )            
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                            ->leftJoin('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                            ->where('stock_transactions.type','in')
                            ->where('stock_transactions.branch_id', $user_branch_id)
                            ->orderByDesc('invoice','date');
                            
            $catalog  = Stock::where('branch_id', $user_branch_id)->get();
            $branches = Branch::where('id', $user_branch_id)->get();
            $products = Product::orderBy('code')->get();
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name', 'products.unit')
                                ->join('products', 'stocks.product_id', '=', 'products.id')
                                ->orderBy('products.code')
                                ->where('branch_id', $user_branch_id)
                                ->get();
        }
        
        if($branch == Null) {
            $stock_in = $stock_in;
        } else {
            $stock_in = $stock_in->where('stock_transactions.branch_id', $branch);
        }

        if($filter == 'Hari Ini' || $filter == Null) {
            $stock_in = $stock_in->where('stock_transactions.date', now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();
        }

        if($filter == 'Tanggal') {
            $stock_in = $stock_in->where('stock_transactions.date', $date_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'Bulan') {
            $stock_in = $stock_in->where(DB::raw('substr(stock_transactions.date,1,7)'), $month_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'Tahun') {
            $stock_in = $stock_in->where(DB::raw('substr(stock_transactions.date,1,4)'), $year_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'custom') {
            $stock_in = $stock_in->whereBetween('stock_transactions.date', [$date_start, $date_end])->paginate(10)->withQueryString();
        }

        return view('pages.stock.list_stock_in', compact('stock_in','catalog','branches','products','stocks','suppliers','months'));
    }

    public function stockInStore(Request $request) {
        $branch_id = Auth::user()->branch_id;
        $now = Carbon::now()->format('ymd');
        $getInvoice = DB::table('stock_transactions')
                            ->select(DB::raw('max(invoice) as maxInv'))
                            ->where([
                                [DB::raw('substr(invoice,5,6)'), $now],
                                ['branch_id', $branch_id],
                                ['type', 'in']
                            ])
                            ->first();
        $lastInv = $getInvoice->maxInv;
        $no = (int) substr($lastInv,10,3);
        $no++;
        $invoice = 'STI-'.date('ymd').sprintf('%03s', $no);

        $stock_transaction = new Stock_transaction();
        $stock_transaction->invoice = $invoice;
        $stock_transaction->date = $request->date;
        $stock_transaction->supplier_id = $request->supplier_id;
        $stock_transaction->received_from = $request->diterima_oleh;
        $stock_transaction->remaining = str_replace('.', '', $request->remaining);
        $stock_transaction->dp = str_replace('.', '', $request->dp);
        $stock_transaction->subtotal = str_replace('.', '', $request->subtotal);
        $stock_transaction->type = 'in';
        $stock_transaction->user_id = Auth::user()->id;
        $stock_transaction->branch_id = $branch_id;
        $stock_transaction->desc = $request->desc;
        $stock_transaction->save();

        foreach($request->addProduct as $i => $product){
            $stock_old = Stock::where('id', $product['stock_id'])->pluck('qty')->first();
            $stock_new = $stock_old + $product['qty'];
            Stock::where('id', $product['stock_id'])
                            ->update(['qty' => $stock_new]);

            Stock_transaction_detail::create([
                'stock_transaction_id' => $stock_transaction->id,
                'stock_id' => $product['stock_id'],
                'qty' => $product['qty'],
                'price' => $product['price'],
                'expired' => $product['expired'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function stockOutList(Request $request) {
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
        $user_branch_id = Auth::user()->branch_id;
        $filter     = $request->filter;
        $branch     = $request->branch;
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d'); 
        if(Auth::user()->role == 'Owner') {
            $stock_out   = DB::table('stock_transactions')
                            ->select(
                                'branches.name as branch_name',
                                'users.name as user_name',
                                'stock_transactions.*'
                            )            
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                            ->where('stock_transactions.type','out')
                            ->orderByDesc('invoice','date');
                            
            $catalog  = Stock::get();
            $branches = Branch::get();
            $products = Product::orderBy('code')->get();
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name')
                                ->join('products', 'stocks.product_id', '=', 'products.id')
                                ->orderBy('products.code')
                                ->get();
        } else {
            $stock_out   = DB::table('stock_transactions')
                            ->select(
                                'branches.name as branch_name',
                                'users.name as user_name',
                                'stock_transactions.*'
                            )            
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                            ->where('stock_transactions.type','out')
                            ->where('stock_transactions.branch_id', $user_branch_id)
                            ->orderByDesc('invoice','date');
                            
            $catalog  = Stock::where('branch_id', $user_branch_id)->get();
            $branches = Branch::where('id', $user_branch_id)->get();
            $products = Product::orderBy('code')->get();
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name')
                                ->join('products', 'stocks.product_id', '=', 'products.id')
                                ->orderBy('products.code')
                                ->where('branch_id', $user_branch_id)
                                ->get();
        }
        
        if($branch == Null) {
            $stock_out = $stock_out;
        } else {
            $stock_out = $stock_out->where('stock_transactions.branch_id', $branch);
        }

        if($filter == 'Hari Ini' || $filter == Null) {
            $stock_out = $stock_out->where('stock_transactions.date', now()->today()->format('Y-m-d'))->paginate(10)->withQueryString();
        }

        if($filter == 'Tanggal') {
            $stock_out = $stock_out->where('stock_transactions.date', $date_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'Bulan') {
            $stock_out = $stock_out->where(DB::raw('substr(stock_transactions.date,1,7)'), $month_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'Tahun') {
            $stock_out = $stock_out->where(DB::raw('substr(stock_transactions.date,1,4)'), $year_selected)->paginate(10)->withQueryString();
        }

        if($filter == 'custom') {
            $stock_out = $stock_out->whereBetween('stock_transactions.date', [$date_start, $date_end])->paginate(10)->withQueryString();
        }

        return view('pages.stock.list_stock_out', compact('stock_out','catalog','branches','products','stocks','months'));
    }

    public function stockOutStore(Request $request) {
        $branch_id = Auth::user()->branch_id;
        $now = Carbon::now()->format('ymd');
        $getInvoice = DB::table('stock_transactions')
                            ->select(DB::raw('max(invoice) as maxInv'))
                            ->where([
                                [DB::raw('substr(invoice,5,6)'), $now],
                                ['branch_id', $branch_id],
                                ['type', 'out']
                            ])
                            ->first();
        $lastInv = $getInvoice->maxInv;
        $no = (int) substr($lastInv,10,3);
        $no++;
        $invoice = 'STO-'.date('ymd').sprintf('%03s', $no);

        $stock_transaction = new Stock_transaction();
        $stock_transaction->invoice       = $invoice;
        $stock_transaction->date          = $request->date;
        $stock_transaction->received_from = $request->diterima_oleh;
        $stock_transaction->type          = 'out';
        $stock_transaction->user_id       = Auth::user()->id;
        $stock_transaction->branch_id     = $branch_id;
        $stock_transaction->desc          = $request->desc;
        $stock_transaction->save();

        foreach($request->addProduct as $i => $product){
            $stock_old = Stock::where('id', $product['stock_id'])->pluck('qty')->first();
            $stock_new = $stock_old - $product['qty'];
            if($stock_old < $product)
            Stock::where('id', $product['stock_id'])
                            ->update(['qty' => $stock_new]);

            Stock_transaction_detail::create([
                'stock_transaction_id' => $stock_transaction->id,
                'stock_id' => $product['stock_id'],
                'qty' => $product['qty'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function stockDetail($id) {
        $details = Stock_transaction_detail::select(
                                            'stock_transaction_details.qty',
                                            'stock_transaction_details.price',
                                            'stock_transaction_details.expired',
                                            'products.code as product_code',
                                            'products.name as product_name',
                                            'stock_transactions.type',
                                            'stock_transactions.date',
                                            'stock_transactions.invoice',
                                            'stock_transactions.dp',
                                            'stock_transactions.remaining',
                                            'stock_transactions.subtotal',
                                            'stock_transactions.desc',
                                            'branches.name as branch_name',
                                            'users.name as user_name',
                                            'suppliers.name as supplier'
                                        )
                                        ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                                        ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                                        ->join('products', 'stocks.product_id', '=', 'products.id')
                                        ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                                        ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                                        ->leftJoin('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                                        ->where('stock_transaction_details.stock_transaction_id', $id)
                                        ->orderBy('products.code')
                                        ->get();
        
        return view('pages.stock.detail_stock', compact('details'));
    }

    public function stockEdit($id) {
        $suppliers = Supplier::get();
        $stocks = Stock_transaction_detail::select(
                                            'stock_transaction_details.qty',
                                            'stock_transaction_details.price',
                                            'stock_transaction_details.expired',
                                            'products.code as product_code',
                                            'products.name as product_name',
                                            'stocks.id as stock_id',
                                            'stock_transactions.id',
                                            'stock_transactions.type',
                                            'stock_transactions.desc',
                                            'stock_transactions.supplier_id',
                                            'stock_transactions.dp',
                                            'stock_transactions.received_from',
                                            'stock_transactions.date',
                                            'stock_transactions.invoice',
                                            'stock_transactions.remaining',
                                            'stock_transactions.subtotal',
                                            'branches.name as branch_name',
                                            'users.name as user_name',
                                            'suppliers.id as supplier_id'
                                        )
                                        ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                                        ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                                        ->join('products', 'stocks.product_id', '=', 'products.id')
                                        ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                                        ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                                        ->join('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                                        ->where('stock_transaction_details.stock_transaction_id', $id)
                                        ->get();
        
        return view('pages.stock.edit_stock', compact('stocks','suppliers'));
    }

    public function stockUpdate(Request $request, $id) {
        $stock_transaction = Stock_transaction::find($id);
        $stock_transaction->date          = $request->date;
        $stock_transaction->received_from = $request->received_from;
        $stock_transaction->supplier_id   = $request->supplier_id;
        $stock_transaction->remaining     = str_replace('.', '', $request->remaining);
        $stock_transaction->dp            = str_replace('.', '', $request->dp);
        $stock_transaction->subtotal      = str_replace('.', '', $request->subtotal);
        $stock_transaction->desc          = $request->desc;
        $stock_transaction->user_id       = Auth::user()->id;
        $stock_transaction->save();

        foreach($request->addProduct as $i => $product){
            Stock_transaction_detail::where([
                ['stock_transaction_id', $id],
                ['stock_id', $product['stock_id']]
            ])->update([
                'price' => $product['price']
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function stockPrint($id) {
        $data = DB::table('stock_transaction_details')
                    ->select(
                        'stock_transactions.*',
                        'products.code as product_code',
                        'products.name as product_name',
                        'products.unit as product_unit',
                        'stock_transaction_details.qty',
                        'stock_transaction_details.expired',
                        'users.name as user_name',
                        'suppliers.name as supplier'
                    )
                    ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                    ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                    ->join('products', 'stocks.product_id', '=', 'products.id')
                    ->join('users', 'stock_transactions.user_id', '=', 'users.id')
                    ->leftJoin('suppliers', 'stock_transactions.supplier_id', '=', 'suppliers.id')
                    ->where('stock_transactions.id', $id)
                    ->get();
        
        $filename = $data[0]->id.'.pdf';
        $filePath = storage_path("pdf/$filename");
        $pdf      = PDF::loadView('pages.invoice.invoice_stock', ['print' => $data]);
        $pdf->save($filePath);
        $base64TxtDto = chunk_split(base64_encode(file_get_contents($filePath)));
        unlink($filePath);

        return response()->json([
            'filename' => $base64TxtDto
        ]);
    }




    // Get Unit
    public function getUnit(Request $request){
        $product   = Stock::select('product_id')->where('id',$request->id)->first();
        $unit = Product::select('unit')->where('id', $product->product_id)->first();
        return json_encode($unit);
    }
}
