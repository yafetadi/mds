<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\Credit;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Salesman;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Maatwebsite\Excel\Facades\Excel;
use Svg\Tag\Rect;

class CustomerController extends Controller
{
    public function list(Request $request) {
        $user_branch_id = Auth::user()->branch_id;
        $salesmen  = User::where('role', 'Salesman');

        if(Auth::user()->role == 'Owner') {
            $salesmen  = $salesmen->get();
            $customers = Customer::select('customers.*','salesmen.name as salesman')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('company', 'like', "%{$request->keyword}%");
                })
                ->join('salesmen','customers.salesman_id','=','salesmen.id')
                ->orderBy('company')
                ->paginate(10)
                ->withQueryString();
        } else {
            $salesmen  = $salesmen->where('branch_id', $user_branch_id)->get();
            $customers = Customer::select('customers.*','salesmen.name as salesman')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('customers.company', 'like', "%{$request->keyword}%");
                })
                ->join('users', 'customers.user_id', '=', 'users.id')
                ->join('salesmen','customers.salesman_id','=','salesmen.id')
                ->where('users.branch_id', $user_branch_id)
                ->orderBy('company')
                ->paginate(10)
                ->withQueryString();
        }

        return view('pages.customer.list', compact('customers','salesmen'));
    }

    public function store(Request $request) {
        $validate = \Validator::make($request->all(), [
            'salesman_id' => 'required'
        ]);

        if($validate->fails()) {
            return redirect()->back()->with('error', 'Salesman tidak boleh kosong');
        } else {
            Customer::create([
                'company' => $request->company,
                'name'    => $request->name,
                'address' => $request->address,
                'city'    => $request->city,
                'phone'   => $request->phone,
                'tenor'   => $request->tenor,
                'user_id' => Auth::user()->id,
                'salesman_id' => $request->salesman_id
            ]);
    
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        }
    }

    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        $customer->company = $request->company;
        $customer->name    = $request->name;
        $customer->address = $request->address;
        $customer->city    = $request->city;
        $customer->phone   = $request->phone;
        $customer->tenor   = $request->tenor;
        $customer->user_id = $request->user_id;
        $customer->save();

        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function detail(Request $request, $id) {
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
        $filter         = $request->filter;
        $date_selected  = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected  = $request->year_selected;
        $date_start     = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end       = Carbon::parse($request->date_end)->format('Y-m-d'); 
        $customer       = Customer::find($id);
        $order_detail   = Order_detail::get();
        $orders         = Order::where([
                                ['customer_id', $id],
                                ['status', 'print']
                            ])
                            ->orderBy('invoice');
                    
        $credits        = DB::table('credits')
                            ->select('remaining')
                            ->join('orders','credits.order_id','=','orders.id')
                            ->where([
                                ['orders.customer_id', $id],
                                ['credits.status','Belum Lunas']
                            ]);

        if($filter == 'Hari Ini' || $filter == Null) {
            $orders    = $orders->where('date', now()->today()->format('Y-m-d'))->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,7)'), now()->today()->format('Y-m-d'))->get();
            $date      = now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $orders    = $orders->where('date', $date_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,10)'), $date_selected)->get();
            $date      = Carbon::parse($date_selected)->format('d M Y');
        }

        if($filter == 'Bulan') {
            $orders    = $orders->where(DB::raw('substr(date,1,7)'), $month_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,7)'), $month_selected)->get();
            $date      = Carbon::parse($month_selected)->format('M').' '.date('Y');
        }

        if($filter == 'Tahun') {
            $orders    = $orders->where(DB::raw('substr(date,1,4)'), $year_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,4)'), $date_selected)->get();
            $date      = Carbon::parse($year_selected)->format('Y');
        }

        if($filter == 'custom') {
            $orders    = $orders->whereBetween('date', [$date_start, $date_end])->get();
            $credits   = $credits->whereBetween(DB::raw('substr(credits.created_at,1,10)'), [$date_start, $date_end])->get();
            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        $total_order = $orders->count();
        $total_grandtotal = $orders->sum('grandtotal');
        $total_remaining = $credits->sum('remaining');
        
        return view('pages.customer.detail', compact('date','months','customer','orders','order_detail','total_order','total_grandtotal','total_remaining'));
    }

    public function edit($id) {
        $user_branch_id = Auth::user()->branch_id;
        $customer = Customer::find($id);
        $salesmen = Salesman::get();

        if(Auth::user()->role == 'Owner') {
            $salesmen = $salesmen->get();
        } else {
            $salesmen = $salesmen->where('branch_id', $user_branch_id)->get();
        }
        
        return view('pages.customer.edit', compact('customer','salesmen'));
    }

    public function importExcel(Request $request){
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('data_customer',$nama_file);
 
		Excel::import(new CustomerImport, public_path('/data_customer/'.$nama_file));
        
		echo 'berhasil!';
    }

    public function supplier_list() {
        $suppliers = Supplier::paginate(10)->withQueryString();

        return view('pages.supplier.list', compact('suppliers'));
    }

    public function supplier_store(Request $request) {
        Supplier::create([
            'name'    => $request->name,
            'address' => $request->address,
            'phone'   => $request->phone,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function supplier_edit($id) {
        $supplier = Supplier::find($id);

        return view('pages.supplier.edit', compact('supplier'));
    }

    public function supplier_update(Request $request, $id) {
        $supplier = Supplier::find($id);
        $supplier->name    = $request->name;
        $supplier->address = $request->address;
        $supplier->phone   = $request->phone;
        $supplier->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function supplier_delete($id) {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}