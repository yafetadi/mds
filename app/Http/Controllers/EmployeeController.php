<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Credit;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Salesman;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'confirmed'],
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal ubah password! Konfirmasi password tidak sama.');
        }

        $user = User::find($id);
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function list()
    {
        $employee = User::where('role', '<>', 'Owner')->get();
        $salesmen  = Salesman::get();
        $branches = Branch::get();
        $areas    = Area::get();
        $roles    = array(
            'Manager' => 'Supervisor',
            'Admin' => 'Admin',
            'Finance' => 'Finance',
            'Purchase' => 'Purchase',
            'Gudang' => 'Gudang',
            'Driver' => 'Driver',
            'Cleaning Service' => 'Cleaning Service'
        );

        return view('pages.employee.list', compact('employee', 'branches', 'areas', 'roles','salesmen'));
    }

    public function store(Request $request)
    {
        $cek = User::where('email', $request->email)->first();

        if (empty($cek)) {
            User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'phone'     => $request->phone,
                'address'   => $request->address,
                'role'      => $request->role,
                'branch_id' => $request->branch_id,
                'area_id'   => $request->area_id
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Data tidak tersimpan. Email sudah terpakai.');
        }
    }

    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->name    = $request->name;
        $employee->email   = $request->email;
        $employee->phone   = $request->phone;
        $employee->address = $request->address;
        $employee->branch_id = $request->branch_id;
        $employee->area_id = $request->area_id;
        $employee->role    = $request->role;
        if(isset($request->password)){
            $employee->password = Hash::make($request->password);
        }
        $employee->save();

        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function delete($id) {
        $employee = User::find($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function salesman_list() {
        $salesmen  = Salesman::get();
        $branches = Branch::get();
        $areas    = Area::get();

        return view('pages.employee.list_salesman', compact('salesmen','branches','areas'));
    }

    public function salesman_store(Request $request) {
        Salesman::create([
            'name'      => $request->name,
            'address'   => $request->address,
            'phone'     => $request->phone,
            'branch_id' => $request->branch_id,
            'area_id'   => $request->area_id,
            'user_id'   => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function salesman_update(Request $request, $id) {
        $salesman = Salesman::find($id);
        $salesman->name      = $request->name;
        $salesman->address   = $request->address;
        $salesman->phone     = $request->phone;
        $salesman->branch_id = $request->branch_id;
        $salesman->area_id   = $request->area_id;
        $salesman->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function salesman_delete($id) {
        $salesman = Salesman::find($id);
        $salesman->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function detailSalesman(Request $request, $id) {
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
        $products = Product::orderBy('code')->get();
        $filter     = $request->filter;
        $product_selected = $request->product;
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d'); 
        $salesman  = Salesman::find($id);
        $customers = DB::table('orders')
                        ->select(
                            'customers.id',
                            'customers.company',
                            DB::raw('sum(order_details.qty) as count'),
                            DB::raw('sum(orders.grandtotal) as total')
                        )
                        ->join('customers','orders.customer_id','=','customers.id')
                        ->join('order_details','orders.id','=','order_details.order_id')
                        ->join('products','order_details.product_id','=','products.id')
                        ->when($product_selected, function ($query) use ($product_selected) {
                            $query->where('products.id', $product_selected);
                        })
                        ->where([
                            ['orders.salesman_id', $id],
                            ['orders.status' ,'print']
                        ])
                        ->groupBy('orders.customer_id')
                        ->orderBy('customers.company');

        $orders    = Order::where([
                            ['salesman_id', $id],
                            ['status', 'print']
                        ]);
                    
        $credits   = DB::table('credits')
                        ->select(
                            'credits.nominal',
                            'credits.remaining'
                        )
                        ->join('orders','credits.order_id','=','orders.id')
                        ->where([
                            ['orders.salesman_id', $id],
                            ['credits.status','Belum Lunas']
                        ]);

        if($filter == 'Hari Ini' || $filter == Null) {
            $customers = $customers->where('orders.date', now()->today()->format('Y-m-d'))->get();
            $orders    = $orders->where('date', now()->today()->format('Y-m-d'))->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,7)'), now()->today()->format('Y-m-d'))->get();
            $date      = now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $customers = $customers->where('orders.date', $date_selected)->get();
            $orders    = $orders->where('date', $date_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,10)'), $date_selected)->get();
            $date      = Carbon::parse($date_selected)->format('d M Y');
        }

        if($filter == 'Bulan') {
            $customers = $customers->where(DB::raw('substr(orders.date,1,7)'), $month_selected)->get();
            $orders    = $orders->where(DB::raw('substr(date,1,7)'), $month_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,7)'), $month_selected)->get();
            $date      = Carbon::parse($month_selected)->format('M').' '.date('Y');
        }

        if($filter == 'Tahun') {
            $customers = $customers->where(DB::raw('substr(orders.date,1,4)'), $year_selected)->get();
            $orders    = $orders->where(DB::raw('substr(date,1,4)'), $year_selected)->get();
            $credits   = $credits->where(DB::raw('substr(credits.created_at,1,4)'), $date_selected)->get();
            $date      = Carbon::parse($year_selected)->format('Y');
        }

        if($filter == 'custom') {
            $customers = $customers->whereBetween('date', [$date_start, $date_end])->get();
            $orders    = $orders->whereBetween('date', [$date_start, $date_end])->get();
            $credits   = $credits->whereBetween(DB::raw('substr(credits.created_at,1,10)'), [$date_start, $date_end])->get();
            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        $total_order      = $orders->count();
        $total_grandtotal = $orders->sum('grandtotal');
        $total_remaining  = $credits->sum('remaining');
        $total_paid       = $credits->sum('nominal') - $credits->sum('remaining') + $orders->where('payment_method','cash')->sum('grandtotal');
        $all_grandtotal   = Order::where('status','print')->sum('grandtotal');
        $percentage       = ($total_grandtotal > 0) ? ($total_grandtotal / $all_grandtotal) * 100 : 0;
        
        return view('pages.employee.detail_salesman', compact('date','products','months','salesman','customers','total_order','total_grandtotal','total_remaining','percentage','total_paid'));
    }

    public function getSalesmanDetail($id) {
        $orders = Order::where([
            ['customer_id', $id],
            ['status', 'print']
        ])
        ->orderBy('invoice')
        ->get();
        $order_detail = Order_detail::get();

        return view('pages.employee.detail_invoice_salesman', compact('orders','order_detail'));
    }

    public function area_list() {
        $areas    = Area::get();
        $branches = Branch::get();

        return view('pages.area.list', compact('areas', 'branches'));
    }

    public function area_store(Request $request) {
        Area::create([
            'name'      => $request->name,
            'branch_id' => $request->branch_id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function area_update(Request $request, $id) {
        $area = Area::find($id);
        $area->name = $request->name;
        $area->branch_id = $request->branch_id;
        $area->save();

        return redirect()->back()->with('Data berhasil diubah.');
    }

    public function area_delete($id) {
        $cek = User::where('area_id', $id)->get();
        if (empty($cek)) {
            $area = Area::find($id);
            $area->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus. Data Area sedang dipakai.');
        }
    }

    public function getAreas(Request $request) {
        $areass = Area::where('branch_id', 'LIKE', '%' . $request->result . '%');
        return json_encode($areass->get());
    }
}
