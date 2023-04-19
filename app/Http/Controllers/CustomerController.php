<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Salesman;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
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

    public function detail($id) {
        $year = now()->format('Y');
        $customer = Customer::find($id);
        $orders   = Order::where([
                            ['customer_id', $id],
                            ['status', 'print']
                        ])
                        ->where(DB::raw('substr(updated_at,1,4)'), $year)
                        ->orderBy('invoice')
                        ->get();

        $total_grandtotal = $orders->sum('grandtotal');

        return view('pages.customer.detail', compact('customer','orders','total_grandtotal'));
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