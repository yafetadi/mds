<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use App\Models\Branch;
use App\Models\Operational;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportStock(Request $request) {
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
        $date       = "";
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d');

        if(Auth::user()->role =='Owner') {
            $branches   = Branch::get();
            $stock_in   = DB::table('stock_transaction_details')
                            ->select(
                                'stock_transactions.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(stock_transaction_details.qty) as total_qty')
                            )
                            ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                            ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                            ->join('products', 'stocks.product_id', '=', 'products.id')            
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->where('stock_transactions.type','in')
                            ->groupBy('stock_transaction_details.stock_id')
                            ->orderBy('branches.id');

            $stock_out  = DB::table('stock_transaction_details')
                            ->select(
                                'stock_transactions.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(stock_transaction_details.qty) as total_qty')
                            )            
                            ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                            ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                            ->join('products', 'stocks.product_id', '=', 'products.id')            
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->where('stock_transactions.type','out')
                            ->groupBy('stock_transaction_details.stock_id')
                            ->orderBy('branches.id');
            
            $order      = DB::table('order_details')
                            ->select(
                                'orders.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(order_details.qty) as total_qty')
                            )
                            ->join('products', 'order_details.product_id', '=', 'products.id')
                            ->join('orders', 'order_details.order_id', '=', 'orders.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->where('orders.status','print')
                            ->groupBy('products.id')
                            ->orderBy('branches.id');
        } else {
            $branches = Branch::where('id', $user_branch_id)->get();
            $stock_in   = DB::table('stock_transaction_details')
                            ->select(
                                'stock_transactions.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(stock_transaction_details.qty) as total_qty')
                            )
                            ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                            ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                            ->join('products', 'stocks.product_id', '=', 'products.id')            
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->where([
                                ['stock_transactions.type','in'],
                                ['stock_transactions.branch_id', $user_branch_id]
                            ])
                            ->groupBy('stock_transaction_details.stock_id')
                            ->orderBy('products.code');

            $stock_out  = DB::table('stock_transaction_details')
                            ->select(
                                'stock_transactions.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(stock_transaction_details.qty) as total_qty')
                            )            
                            ->join('stock_transactions', 'stock_transaction_details.stock_transaction_id', '=', 'stock_transactions.id')
                            ->join('stocks', 'stock_transaction_details.stock_id', '=', 'stocks.id')
                            ->join('products', 'stocks.product_id', '=', 'products.id')            
                            ->join('branches', 'stocks.branch_id', '=', 'branches.id')
                            ->where([
                                ['stock_transactions.type','out'],
                                ['stock_transactions.branch_id', $user_branch_id]
                            ])
                            ->groupBy('stock_transaction_details.stock_id')
                            ->orderBy('products.code');
            
            $order      = DB::table('order_details')
                            ->select(
                                'orders.invoice',
                                'branches.name as branch_name',
                                'products.code as product_code',
                                'products.name as product_name',
                                'products.unit as product_unit',
                                DB::raw('sum(order_details.qty) as total_qty')
                            )
                            ->join('products', 'order_details.product_id', '=', 'products.id')
                            ->join('orders', 'order_details.order_id', '=', 'orders.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->where([
                                ['orders.branch_id', $user_branch_id],
                                ['orders.status','print']
                            ])
                            ->groupBy('products.id')
                            ->orderBy('products.code');
        }
        

        if($branch == Null) {
            $stock_in  = $stock_in;
            $stock_out = $stock_out;
            $order     = $order;
        } else {
            $stock_in  = $stock_in->where('stock_transactions.branch_id', $branch);
            $stock_out = $stock_out->where('stock_transactions.branch_id', $branch);
            $order     = $order->where('orders.branch_id', $branch);
        }

        if($filter == 'Hari Ini' || $filter == Null) {
            $stock_in  = $stock_in->where('stock_transactions.date', now()->today()->format('Y-m-d'))->get();
            $stock_out = $stock_out->where('stock_transactions.date', now()->today()->format('Y-m-d'))->get();
            $order     = $order->where(DB::raw('substr(orders.updated_at,1,10)'), now()->today()->format('Y-m-d'))->get();

            $date   = now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $stock_in  = $stock_in->where('stock_transactions.date', $date_selected)->get();
            $stock_out = $stock_out->where('stock_transactions.date', $date_selected)->get();
            $order     = $order->where(DB::raw('substr(orders.updated_at,1,10)'), $date_selected)->get();

            $date   = Carbon::parse($date_selected)->format('d M Y');
        }

        if($filter == 'Bulan') {
            $stock_in  = $stock_in->where(DB::raw('substr(stock_transactions.date,1,7)'), $month_selected)->get();
            $stock_out = $stock_out->where(DB::raw('substr(stock_transactions.date,1,7)'), $month_selected)->get();
            $order     = $order->where(DB::raw('substr(orders.updated_at,1,7)'), $month_selected)->get();

            $date   = Carbon::parse($month_selected)->format('M').' '.date('Y');
        }

        if($filter == 'Tahun') {
            $stock_in  = $stock_in->where(DB::raw('substr(stock_transactions.date,1,4)'), $year_selected)->get();
            $stock_out = $stock_out->where(DB::raw('substr(stock_transactions.date,1,4)'), $year_selected)->get();
            $order     = $order->where(DB::raw('substr(orders.updated_at,1,4)'), $year_selected)->get();

            $date   = Carbon::parse($year_selected)->format('Y');
        }

        if($filter == 'custom') {
            $stock_in  = $stock_in->whereBetween('stock_transactions.date', [$date_start, $date_end])->get();
            $stock_out = $stock_out->whereBetween('stock_transactions.date', [$date_start, $date_end])->get();

            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        return view('pages.report.stock', [
            'filter'         => $filter,
            'date'           => $date,
            'months'         => $months,
            'branches'       => $branches,
            'stock_in'       => $stock_in,
            'stock_out'      => $stock_out,
            'order'          => $order,
            'total_outstock' => $this->count_stock_out($stock_out,$order),
            'total_instock'  => $this->count_stock_in($stock_in)
        ]);
    }

    private function count_stock_out($stock_out,$order) {
        $total_out = 0;

        if($stock_out->count() > 0 or $order->count() > 0) {
            $out  = $stock_out->pluck('total_qty')->all();
            $total_stock_out  = array_sum($out);
            $sold = $order->pluck('total_qty')->all();
            $total_sold = array_sum($sold);
            $total_out = $total_stock_out + $total_sold;
        }

        return $total_out;
    }

    private function count_stock_in($stock_in) {
        $total_stock_in = 0;

        if($stock_in->count() > 0) {
            $in             = $stock_in->pluck('total_qty')->all();
            $total_stock_in = array_sum($in);
        }

        return $total_stock_in;
    }

    public function reportSelling(Request $request) {
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
        $date       = "";
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d');

        if(Auth::user()->role =='Owner') {
            $branches   = Branch::get();
            $orders   = DB::table('orders')
                            ->select(
                                'orders.id',
                                'orders.invoice',
                                'orders.date',
                                'orders.grandtotal',
                                'orders.payment_method',
                                'customers.company as customer',
                                'branches.name as branch',
                                'credits.remaining',
                                'credits.status'
                            )
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->leftJoin('credits', 'orders.id', '=', 'credits.order_id')
                            ->where('orders.status', 'print')
                            ->orderBy('orders.date')
                            ->orderBy('orders.invoice');
        } else {
            $branches = Branch::where('id', $user_branch_id)->get();
            $orders   = DB::table('orders')
                            ->select(
                                'orders.id',
                                'orders.invoice',
                                'orders.date',
                                'orders.grandtotal',
                                'orders.payment_method',
                                'customers.company as customer',
                                'branches.name as branch',
                                'credits.remaining',
                                'credits.status'
                            )
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->leftJoin('credits', 'orders.id', '=', 'credits.order_id')
                            ->where([
                                ['branch_id', $user_branch_id],
                                ['orders.status', 'print']
                            ])
                            ->orderBy('orders.date')
                            ->orderBy('orders.invoice');
        }

        if($branch == Null) {
            $orders = $orders;
        } else {
            $orders = $orders->where('orders.branch_id', $branch);
        }

        if($filter == 'Hari Ini' || $filter == Null) {
            $orders = $orders->where('orders.date', now()->today()->format('Y-m-d'))->get();
            $date   = now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $orders = $orders->where('orders.date', $date_selected)->get();
            $date   = Carbon::parse($date_selected)->format('d M Y');
        }

        if($filter == 'Bulan') {
            $orders = $orders->where(DB::raw('substr(orders.date,1,7)'), $month_selected)->get();
            $date   = Carbon::parse($month_selected)->format('M').' '.date('Y');
        }

        if($filter == 'Tahun') {
            $orders = $orders->where(DB::raw('substr(orders.date,1,4)'), $year_selected)->get();
            $date   = Carbon::parse($year_selected)->format('Y');
        }

        if($filter == 'custom') {
            $orders    = $orders->whereBetween('orders.date', [$date_start, $date_end])->get();
            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        return view('pages.report.selling', [
            'filter'         => $filter,
            'date'           => $date,
            'months'         => $months,
            'branches'       => $branches,
            'orders'         => $orders
        ]);
    }

    public function reportFinance(Request $request) {
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
        $date       = "";
        $date_selected = $request->date_selected;
        $month_selected = date('Y').'-'.$request->month_selected;
        $year_selected = $request->year_selected;
        $date_start = Carbon::parse($request->date_start)->format('Y-m-d');
        $date_end   = Carbon::parse($request->date_end)->format('Y-m-d');

        if(Auth::user()->role =='Owner') {
            $branches   = Branch::get();
            $orders   = DB::table('orders')
                            ->select(
                                'orders.invoice',
                                'orders.date',
                                'orders.grandtotal as subtotal',
                                'orders.payment_method',
                                'customers.company as name',
                                'branches.name as branch',
                                'credits.remaining',
                                'credits.status'
                            )
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->where('orders.status', 'print')
                            ->orderBy('orders.invoice');

            $stock_in   = DB::table('stock_transactions')
                            ->select(
                                'stock_transactions.invoice',
                                'stock_transactions.date',
                                'stock_transactions.subtotal',
                                'suppliers.name as name',
                                'branches.name as branch',
                                'stock_transactions.remaining',
                            )            
                            ->join('stock_transaction_details', 'stock_transactions.id', '=', 'stock_transaction_details.stock_transaction_id')         
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->where('stock_transactions.type','in')
                            ->orderBy('stock_transactions.invoice');
        } else {
            $branches = Branch::where('id', $user_branch_id)->get();
            $orders   = DB::table('orders')
                            ->select(
                                'orders.*',
                                'customers.company as customer',
                                'branches.name as branch'
                            )
                            ->join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->join('branches', 'orders.branch_id', '=', 'branches.id')
                            ->where([
                                ['orders.branch_id', $user_branch_id],
                                ['orders.status', 'print']
                            ])
                            ->orderBy('orders.invoice');

            $stock_in   = DB::table('stock_transactions')
                            ->select(
                                'stock_transactions.*',
                                'stock_transactions.received_from as customer',
                                'branches.name as branch'
                            )            
                            ->join('stock_transaction_details', 'stock_transactions.id', '=', 'stock_transaction_details.stock_transaction_id')         
                            ->join('branches', 'stock_transactions.branch_id', '=', 'branches.id')
                            ->where([
                                ['stock_transactions.type','in'],
                                ['stock_transactions.branch_id', $user_branch_id]
                            ])
                            ->orderBy('stock_transactions.invoice');
        }

        if($branch == Null) {
            $orders = $orders;
            $stock_in = $stock_in;
        } else {
            $orders = $orders->where('orders.branch_id', $branch);
            $stock_in = $stock_in->where('stock_transactions.branch_id', $branch);
        }

        if($filter == 'Hari Ini' || $filter == Null) {
            $orders       = $orders->where(DB::raw('substr(orders.updated_at,1,10)'), now()->today()->format('Y-m-d'))->get();
            $stock_in     = $stock_in->where('stock_transactions.date', now()->today()->format('Y-m-d'))->get();

            $date   = now()->today()->format('d M Y');
        }

        if($filter == 'Tanggal') {
            $orders       = $orders->where(DB::raw('substr(orders.updated_at,1,10)'), $date_selected)->get();
            $stock_in     = $stock_in->where('stock_transactions.date', $date_selected)->get();

            $date   = Carbon::parse($date_selected)->format('d M Y');
        }

        if($filter == 'Bulan') {
            $orders       = $orders->where(DB::raw('substr(orders.updated_at,1,7)'), $month_selected)->get();
            $stock_in     = $stock_in->where(DB::raw('substr(stock_transactions.date,1,7)'), $month_selected)->get();

            $date   = Carbon::parse($month_selected)->format('M').' '.date('Y');
        }

        if($filter == 'Tahun') {
            $orders       = $orders->where(DB::raw('substr(orders.updated_at,1,4)'), $year_selected)->get();
            $stock_in     = $stock_in->where(DB::raw('substr(stock_transactions.date,1,4)'), $year_selected)->get();

            $date   = Carbon::parse($year_selected)->format('Y');
        }

        if($filter == 'custom') {
            $orders       = $orders->whereBetween(DB::raw('substr(orders.updated_at,1,10)'), [$date_start, $date_end])->get();
            $stock_in     = $stock_in->whereBetween('stock_transactions.date', [$date_start, $date_end])->get();

            $startDate = Carbon::parse($request->date_start)->format('d M Y');
            $endDate   = Carbon::parse($request->date_end)->format('d M Y');
            $date      = $startDate.' sampai '.$endDate;
        }

        $report = $orders->merge($stock_in)->sortBy('updated_at');

        return view('pages.report.finance', [
            'report'         => $report,
            'filter'         => $filter,
            'date'           => $date,
            'months'         => $months,
            'branches'       => $branches,
            'orders'         => $orders,
            'stock_in'       => $stock_in,
            'total_income'   => $this->count_income($orders),
            'total_outcome'  => $this->count_outcome($stock_in),
            'gross_profit'   => $this->count_gross_profit($orders, $stock_in),
            'net_profit'     => $this->count_net_profit($orders, $stock_in)
        ]);
    }

    private function count_income($orders) {
        $total_income = 0;

        if($orders->count() > 0) {
            $income       = $orders->pluck('grandtotal')->all();
            $trans_income = array_sum($income);
            $total_income = $trans_income;
        }

        return $total_income;
    }

    private function count_outcome($stock_in) {
        $total_outcome = 0;

        if($stock_in->count() > 0) {
            $order       = $stock_in->pluck('subtotal')->all();
            $total_order = array_sum($order);
            $total_outcome = $total_order;
        }

        return $total_outcome;
    }

    private function count_gross_profit($orders, $stock_in) {
        $total_gross_profit = 0;

        if($stock_in->count() > 0 or $orders->count() > 0) {
            $order       = $orders->pluck('grandtotal')->all();
            $total_order = array_sum($order);
            $outcome     = $stock_in->pluck('subtotal')->all();
            $sub_outcome  = array_sum($outcome);
            $total_gross_profit = $total_order - $sub_outcome;
        } 

        return $total_gross_profit;
    }

    private function count_net_profit($orders, $stock_in) {
        $total_net_profit = 0;

        if($stock_in->count() > 0 or $orders->count() > 0) {
            $order       = $orders->pluck('grandtotal')->all();
            $total_order = array_sum($order);
            $outcome     = $stock_in->pluck('subtotal')->all();
            $sub_outcome  = array_sum($outcome);
            $total_net_profit = $total_order - $sub_outcome;
        }

        return $total_net_profit;
    }
}
