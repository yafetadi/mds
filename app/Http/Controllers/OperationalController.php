<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use App\Models\Operational_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationalController extends Controller
{
    public function list() {
        $startOfYear = now()->startOfYear()->format('Y-m-d');
        $endOfYear = now()->endOfYear()->format('Y-m-d');
        $operationals = Operational::whereBetween(DB::raw('substr(updated_at,1,10)'), [$startOfYear, $endOfYear])
                                ->paginate(10)
                                ->withQueryString();
        $categories   = Operational_category::get();

        return view('pages.operational.list', compact('operationals', 'categories'));
    }

    public function store(Request $request) {
        Operational::create([
            'name'      => $request->name,
            'desc'      => $request->desc,
            'nominal'   => str_replace('.', '', $request->nominal),
            'user_id'   => Auth::user()->id,
            'branch_id' => Auth::user()->branch_id,
            'operational_category_id' => $request->operational_category_id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function categoryStore(Request $request) {
        Operational_category::create([
            'name'    => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function editCategory($id) {
        $category = Operational_category::find($id);

        return view('pages.operational.edit_category', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $category = Operational_category::find($id);
        $category->name = $request->name;
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
        $operational->name = $request->name;
        $operational->desc = $request->desc;
        $operational->nominal = str_replace('.', '', $request->nominal);
        $operational->operational_category_id = $request->operational_category_id;
        $operational->user_id = Auth::user()->id;
        $operational->save();

        return redirect()->back()->with('success','Data berhasil diubah');
    }
}
