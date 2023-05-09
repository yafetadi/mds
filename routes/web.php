<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::controller(SellingController::class)->middleware('auth')->group(function () {
    Route::get('/selling', 'selling')->name('selling');
    Route::get('/list-customer', 'getCustomerList');
    Route::get('/list-salesman', 'getSalesmanList');
    Route::get('/list-stock', 'getStockList');
    Route::get('/list-order/{id}', 'getOrderList');
    Route::post('/add-orderinfo', 'addOrderInfo');
    Route::post('/add-orderlist/{id}', 'addOrderList');
    Route::post('/update-orderlist', 'updateOrderList');
    Route::get('/find-order-by-id/{id}', 'findOrderById');
    Route::get('/subtotal/{id}', 'getSubtotal');
    Route::get('/disc/{id}', 'getDisc');
    Route::get('/ppn/{id}', 'getPpn');
    Route::post('remove-orderlist', 'removeOrderList');
    Route::post('remove-order/{id}', 'removeOrder');
    Route::post('/print/{id}', 'print');
});

Route::controller(TransactionController::class)->middleware('auth')->group(function () {
    Route::get('/transaction/history', 'history')->name('transaction.history');
    Route::get('/transaction/history/detail/{id}', 'detail');
    Route::get('/transaction/history/return/{id}', 'return');
    Route::post('/transaction/history/return/store/{id}', 'returnStore')->name('return.store');
    Route::get('/transaction/credit', 'credit')->name('transaction.credit');
    Route::get('/transaction/credit/detail/{id}', 'detailCredit');
    Route::get('/transaction/credit/pay/{id}', 'payCredit');
    Route::post('/transaction/credit/payment/{id}', 'paymentCredit')->name('credit.pay');
    Route::get('/transaction/credit/detail/payment/{id}', 'detailPaymentCredit');
    Route::get('/transaction/history/print/{id}', 'print');
    Route::get('/transaction/debt/list', 'debtList')->name('debt.list');
    Route::get('/transaction/debt/detail/{id}', 'debtDetail');
    Route::post('/transaction/debt/edit/{id}', 'debtPay')->name('debt.edit');
});

Route::controller(EmployeeController::class)->middleware('auth')->group(function () {
    Route::post('/change-password/{id}', 'changePassword')->name('change-password');
    Route::get('/employee/list', 'list')->name('employee.list');
    Route::post('/employee/store', 'store')->name('employee.store');
    Route::get('/employee/salesman/list', 'salesman_list')->name('salesman.list');
    Route::get('/employee/salesman/detail/{id}', 'detailSalesman')->name('salesman.detail');
    Route::post('/employee/salesman/store', 'salesman_store')->name('salesman.store');
    Route::post('/employee/salesman/update/{id}', 'salesman_update')->name('salesman.update');
    Route::delete('/employee/salesman/delete/{id}', 'salesman_delete')->name('salesman.delete');
    Route::get('/get-salesman-detail/{id}', 'getSalesmanDetail');
    Route::get('/get-area', 'getAreas')->name('get.area');
    Route::post('/employee/update/{id}', 'update')->name('employee.update');
    Route::delete('/employee/delete/{id}', 'delete')->name('employee.delete');
    Route::get('/area/list', 'area_list')->name('area.list');
    Route::post('/area/store', 'area_store')->name('area.store');
    Route::post('/area/update/{id}', 'area_update')->name('area.update');
    Route::delete('/area/delete/{id}', 'area_delete')->name('area.delete');
});

Route::controller(CustomerController::class)->middleware('auth')->group(function () {
    Route::get('/customer/list', 'list')->name('customer.list');
    Route::post('/customer/store', 'store')->name('customer.store');
    Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
    Route::post('/customer/update/{id}', 'update')->name('customer.update');
    Route::get('/customer/detail/{id}', 'detail')->name('customer.detail');
    Route::get('/supplier/list', 'supplier_list')->name('supplier.list');
    Route::post('/supplier/store', 'supplier_store')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'supplier_edit');
    Route::post('/supplier/update/{id}', 'supplier_update')->name('supplier.update');
    Route::delete('/supplier/delete/{id}', 'supplier_delete')->name('supplier.delete');
});

Route::controller(ProductController::class)->middleware('auth')->group(function () {
    Route::post('/category/product/store', 'category_store')->name('category_product.store');
    Route::delete('/category/product/delete/{id}', 'category_delete')->name('category_product.delete');
    Route::get('/product/list', 'list')->name('product.list');
    Route::post('/product/store', 'store')->name('product.store');
    Route::post('/product/update/{id}', 'update')->name('product.update');
    Route::delete('/product/delete/{id}', 'delete')->name('product.delete');
    Route::get('/product/recycle/{id}', 'recycle')->name('product.recycle');
    Route::get('/get-product-detail/{id}', 'getProductDetail')->name('product.detail');
    Route::get('/product/forceDelete/{id}', 'forceDelete')->name('product.forceDelete');
    Route::get('/product/price/list', 'priceList')->name('price.list');
    Route::post('/product/price/store', 'priceStore')->name('price.store');
    Route::post('/product/price/update/{id}', 'priceUpdate')->name('price.update');
    Route::delete('/product/price/delete/{id}', 'priceDelete')->name('price.delete');
    Route::get('/get-pricelist-detail/{id}', 'getPricelistDetail')->name('price.detail');
});

Route::controller(StockController::class)->middleware('auth')->group(function () {
    Route::get('/stock/catalog/list', 'catalogList')->name('catalog.list');
    Route::get('/get-catalog-detail/{id}', 'getCatalogDetail')->name('catalog.detail');
    Route::get('/detail-transaction-catalog/{id}', 'detailTransactionCatalog');
    Route::post('/stock/catalog/store', 'catalogStore')->name('catalog.store');
    Route::post('/stock/catalog/update/{id}', 'catalogUpdate')->name('catalog.update');
    Route::delete('/stock/catalog/delete/{id}', 'catalogDelete')->name('catalog.delete');
    Route::get('/stock/in/list', 'stockInList')->name('stock_in.list');
    Route::post('/stock/in/store', 'stockInStore')->name('stock_in.store');
    Route::get('/stock/out/list', 'stockOutList')->name('stock_out.list');
    Route::post('/stock/out/store', 'stockOutStore')->name('stock_out.store');
    Route::get('/stock/detail/{id}', 'stockDetail');
    Route::get('/stock/edit/{id}', 'stockEdit');
    Route::post('/stock/update/{id}', 'stockUpdate')->name('stock_in.update');
    Route::get('/stock/print/{id}', 'stockPrint');
});

Route::controller(OperationalController::class)->middleware('auth')->group(function () {
    Route::get('/operational/list', 'list')->name('operational.list');
    Route::post('/operational/store', 'store')->name('operational.store');
    Route::get('/operational/edit/{id}', 'edit');
    Route::post('/operational/update/{id}', 'update')->name('operational.update');
    Route::post('/operational/category/store', 'categoryStore')->name('category.store');
    Route::get('/operational/category/edit/{id}', 'editCategory');
    Route::post('/operational/category/update/{id}', 'updateCategory')->name('category.update');
    Route::delete('/operational/category/delete/{id}', 'deleteCategory')->name('category.delete');
    Route::get('/operational/category/getcategory', 'getKeteranganFromKategori');
    Route::post('/operational/saldo-awal-store', 'saldoAwalStore')->name('category.saldoAwalStore');
    Route::get('/operational/hapus-operational/{id}', 'hapusOperational');
});

Route::controller(ReportController::class)->middleware('auth')->group(function () {
    Route::get('/report/stock', 'reportStock')->name('report.stock');
    Route::get('/report/finance', 'reportFinance')->name('report.finance');
    Route::get('/report/selling', 'reportSelling')->name('report.selling');
});

Route::get('/invoice/stock', function () {
    return view('pages.invoice.invoice_stock');
});

Route::get('/copy/price', [ProductController::class, 'copyPrice']);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/import-excell', function(){
    return view('pages/customer/import_excel');
});
Route::post('/import-excel', [CustomerController::class, 'importExcel']);
