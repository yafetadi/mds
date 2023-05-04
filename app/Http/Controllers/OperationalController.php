<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use App\Models\Operational_category;
use App\Models\Salesman;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class OperationalController extends Controller
{
    public function list(Request $request) {
        $startOfYear = now()->startOfYear()->format('Y-m-d');
        $endOfYear = now()->endOfYear()->format('Y-m-d');
        $categories   = Operational_category::where('name','<>','Tambah Saldo')->get();
        $cpSales = Salesman::all()->pluck('name');
        $cpUser = User::where('role','<>','Owner')->get()->pluck('name');
        $ambilATM = Operational_category::where('name', 'Tambah Saldo')->get('id');

        $branches = Branch::get();

        
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


        
        
        if($branch == null) {
            $operationalss = Operational::orderBy('created_at');
        } else {
            $operationalss = Operational::where('branch_id', $branch)->orderBy('created_at');
        }

        if($filter == 'Hari Ini' or $filter == Null) {
            $operationalss =$operationalss->where('updated_at', 'LIKE', '%' . now()->today()->format('Y-m-d') . '%')->get();
        }

        if($filter == 'Tanggal') {
            $operationalss = $operationalss->where('updated_at', 'LIKE', '%' . $date_selected . '%')->get();
        }

        if($filter == 'Bulan') {
            $operationalss = $operationalss->where(DB::raw('substr(updated_at,1,7)'), 'LIKE', '%' . $month_selected . '%')->get();
        }

        if($filter == 'Tahun') {
            $operationalss = $operationalss->where(DB::raw('substr(updated_at,1,4)'), 'LIKE', '%' . $year_selected . '%')->get();
        }

        if($filter == 'custom') {
            $operationalss = $operationalss->whereBetween('updated_at', 'LIKE', '%' . [$date_start, $date_end] . '%')->get();
        }





        return view('pages.operational.list', compact([
            'categories', 
            'cpSales', 
            'cpUser', 
            'operationalss', 
            'ambilATM',
            'months',
            'user_branch_id',
            'filter',
            'branch',
            'branches',
            'date_selected',
            'month_selected',
            'year_selected',
            'date_start',
            'date_end',
        ]));


        // $pop = Operational::where('updated_at', 'LIKE', '%' . now()->today()->format('Y-m-d') . '%')->get();
        // dd($pop);
    }

    public function store(Request $request) {
        Operational::create([
            'name'      => $request->name,
            'desc'      => $request->keterangan,
            'nominal'   => str_replace('.', '', $request->nominal),
            'user_id'   => Auth::user()->id,
            'branch_id' => Auth::user()->branch_id,
            'type'      => 'out',
            'operational_category_id' => $request->operational_category_id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function categoryStore(Request $request) {
        Operational_category::create([
            'name'    => $request->name,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
        // dd($request);
    }

    public function editCategory($id) {
        $category = Operational_category::find($id);

        return view('pages.operational.edit_category', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $category = Operational_category::find($id);
        $category->name = $request->name;
        $category->keterangan = $request->keterangan;
        $category->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function deleteCategory($id) {
        $category = Operational_category::find($id);
        $category->delete();

        return redirect()->back()->with('success', 'Data sudah berhasil dihapus');
    }

    public function edit($id) {
        $operational = Operational::find($id);
        $categories  = Operational_category::get();

        return view('pages.operational.edit', compact('operational','categories'));
    } 

    public function update(Request $request, $id) {
        $operational = Operational::find($id);
        $operational->nominal = str_replace('.', '', $request->nominal);
        $operational->user_id = Auth::user()->id;
        $operational->save();

        return redirect()->back()->with('success','Data berhasil diubah');
    }

    public function getKeteranganFromKategori(Request $request){
        $values = Operational_category::find($request->value);

        return response()->json($values);
    }

    public function saldoAwalStore(Request $request){
        Operational::create([
            'nominal'   => str_replace('.', '', $request->saldo),
            'user_id'   => Auth::user()->id,
            'branch_id' => Auth::user()->branch_id,
            'type'      => 'in',
            'operational_category_id' => $request->operational_category_id
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function filter(){
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
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name')
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
            $stocks   = Stock::select('stocks.id', 'products.code', 'products.name')
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
}
