<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBillController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'welcome']);


Route::group(['middleware'=>'auth'],function(){

    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');


});

/*
|--------------------------------------------------------------------------
| admin - branch
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/branch/create', [AdminBranchController::class,'branchCreate'])->name('admin.branch.create');
    Route::post('admin/branch/store', [AdminBranchController::class,'branchStore'])->name('admin.branch.store');

});

/*
|--------------------------------------------------------------------------
| admin - bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/bill/index/{branch}', [AdminBillController::class,'index'])->name('admin.bill.index');

});


/*
|--------------------------------------------------------------------------
| Bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::post('bill/store', [BillController::class,'store'])->name('bill.store');

});


/*
|--------------------------------------------------------------------------
| items
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('item/index/{bill}', [ItemController::class,'index'])->name('item.index');

    Route::post('item/failedprint/store', [ItemController::class,'failedprintStore'])->name('item.failedprint.store');

    Route::post('item/extra/store', [ItemController::class,'extraStore'])->name('item.extra.store');
});

/*
|--------------------------------------------------------------------------
| stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('stock/index', [StockController::class,'index'])->name('stock.index');

    Route::post('stock/store', [StockController::class,'store'])->name('stock.store');

});


require __DIR__.'/auth.php';
