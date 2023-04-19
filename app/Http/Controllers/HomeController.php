<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index() {
        if (Auth::user()->role == 'Owner') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->role == 'Manager') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->role == 'Admin') {
            return redirect()->route('selling');
        }

        if (Auth::user()->role == 'Gudang') {
            return redirect()->route('catalog.list');
        }
    }

    public function dashboard() {
        return view('pages.dashboard');
    }
}
