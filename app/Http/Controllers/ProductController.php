<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Pricelist;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;

class ProductController extends Controller
{
    public function getPricelistDetail($id) {
        $user_branch_id = Auth::user()->branch_id;
        $products  = Product::get();
        $customers = Customer::select('customers.*')
                            ->join('users', 'customers.user_id', '=', 'users.id')
                            ->where('users.branch_id', $user_branch_id)
                            ->get();
        $pricelist = Pricelist::find($id);

        return view('pages.product.edit_pricelist', compact(['products', 'customers', 'pricelist']));
    }

    public function priceList(Request $request) {
        $user_branch_id = Auth::user()->branch_id;
        $categories = Category::orderBy('code')->get();
        $products   = Product::orderBy('code')->get();
        $category   = $request->category_id;
        $pricelists = Pricelist::select('pricelists.id','pricelists.price','products.code as product_code',
                            'products.name as product_name','customers.name as customer_name', 
                            'customers.company as customer_company', 'customers.city',
                            'users.name as user_name','branches.name as branch_name')
                        ->join('products', 'pricelists.product_id', '=', 'products.id')
                        ->leftJoin('customers', 'pricelists.customer_id', '=', 'customers.id')
                        ->join('users', 'pricelists.user_id', '=', 'users.id')
                        ->join('branches', 'pricelists.branch_id', '=', 'branches.id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('products.name', 'like', "%{$request->keyword}%")
                            ->orWhere('customers.name', 'like', "%{$request->keyword}%");
                        })->orderBy('products.code');
                        
        if($category == Null) {
            $pricelists = $pricelists;
        } else {
            $pricelists = $pricelists->where('products.category_id', $category);
        }

        if(Auth::user()->role == 'Owner') {
            $branches   = Branch::get();
            $customers  = Customer::get();
            $pricelists = $pricelists->paginate(10)->withQueryString();
        } else {
            $branches   = Branch::where('id', $user_branch_id)->get();
            $customers  = Customer::select('customers.*')
                                ->join('users', 'customers.user_id', '=', 'users.id')
                                ->where('users.branch_id', $user_branch_id)
                                ->get();
            $pricelists = $pricelists->where('pricelists.branch_id', $user_branch_id)->paginate(10)->withQueryString();
        }
        
        return view('pages.product.pricelist', compact('categories','products','branches','pricelists','customers'));
    }

    public function priceStore(Request $request) {
        $check = Pricelist::where([
            ['product_id', $request->product_id],
            ['customer_id', $request->customer_id],
            ['branch_id', Auth::user()->branch_id]
        ])->first();

        if(empty($check)) {
            Pricelist::create([
                'product_id'  => $request->product_id,
                'customer_id' => $request->customer_id,
                'branch_id'   => Auth::user()->branch_id,
                'user_id'     => Auth::user()->id,
                'price'       => str_replace('.', '', $request->price)
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Harga Produk sudah ada sebelumnya');
        }
    }

    public function priceUpdate(Request $request, $id) {
        $pricelist = Pricelist::find($id);
        $pricelist->price = str_replace('.', '', $request->price);
        $pricelist->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function priceDelete($id) {
        $pricelist = Pricelist::find($id);
        $pricelist->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function getProductDetail($id) {
        $user_branch_id = Auth::user()->branch_id;
        $product = Product::find($id);
        $categories = Category::get();

        return view('pages.product.edit_product', compact(['product', 'categories']));
    }

    public function list(Request $request) {
        $trashed_products = Product::onlyTrashed()->get();
        $categories = Category::orderBy('code')->get();
        $category   = $request->category_id;
        $products   = Product::when($request->keyword, function ($query) use ($request) {
                            $query->where('name', 'like', "%{$request->keyword}%");
                        })->orderBy('code');
                        
        if($category == Null) {
            $products = $products->paginate(10)->withQueryString();;
        } else {
            $products = $products->where('category_id', $category)->paginate(10)->withQueryString();;
        }
        
        return view('pages.product.list', compact('categories','products','trashed_products'));
    }

    public function store(Request $request) {
        $check = Product::where('name', $request->name)->first();

        if(empty($check)) {
            Product::create([
                'category_id' => $request->category_id,
                'code'        => $this->product_code($request->category_id),
                'name'        => $request->name,
                'unit'        => $request->unit,
                'desc'        => $request->desc,
                'user_id'     => Auth::user()->id
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Nama produk sudah ada');
        }
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        if($product->category_id !== $request->category_id) {
            $product->category_id = $request->category_id;
            $product->code        = $this->product_code($request->category_id);
        }
        $product->name   = $request->name;
        $product->unit   = $request->unit;
        $product->desc   = $request->desc;
        $product->save();

        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function delete($id) {
        $check = Stock::where('product_id', $id)->first();

        if(empty($check)) {
            $product = Product::find($id);
            $product->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk masih ada di stok gudang.');
        }
    }

    public function recycle($id) {
        $product = Product::onlyTrashed()->where('id', $id);
        $product->restore();

        return redirect()->back()->with('success', 'Data berhasil dipulihkan.');
    }

    public function forceDelete($id) {
        $product = Product::onlyTrashed()->where('id', $id);
        $product->forceDelete();

        return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen.');
    }

    private function product_code($category_id) {
        $get_maxCode = Product::select(DB::raw('max(substr(code, -2)) as no'))->where('category_id', $category_id)->first();
        $get_codeCat = Category::select('code')->where('id', $category_id)->first();
        $no = (int) $get_maxCode->no;
        $no++;
        $code = $get_codeCat->code.sprintf('%02s', $no);
        $check_on_delete = Product::onlyTrashed()->where('code', $code)->first();
        if(empty($check_on_delete->code)) {
            $code_new = $code;
        } else {
            $code_new = $get_codeCat->code.sprintf('%02s', $no+1);
        }

        return $code_new;
    }

    public function category_store(Request $request) {
        $check = Category::where('name', $request->name)->orWhere('code', $request->code)->first();

        if(empty($check)) {
            Category::create([
                'name'    => Str::upper($request->name),
                'code'    => $request->code,
                'user_id' => Auth::user()->id
            ]);
    
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Nama/Kode Kategori sudah ada');
        }
    }

    public function category_delete($id) {
        $check = Product::where('category_id', $id)->first();

        if(empty($check)) {
            $category = Category::find($id);
            $category->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Masih ada data produk di kategori ini.');
        }
    }

    public function copyPrice() {
        $products = Product::get();
        $pricelist = array();
        foreach($products as $i => $product) {
            $pricelist[$i] = new Pricelist();
            $pricelist[$i]->product_id = $product->id;
            $pricelist[$i]->price = $product->price;
            $pricelist[$i]->branch_id = 1;
            $pricelist[$i]->user_id = $product->user_id;
            $pricelist[$i]->save();
        }
    }
}
