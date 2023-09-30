<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminStatisticController;
use App\Http\Controllers\AdminStatementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBillController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| welcome
|--------------------------------------------------------------------------
*/

Route::get('index2', function(){
    return view('index2');
});

Route::get('/', [HomeController::class,'welcome']);


Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/dashboard', [HomeController::class,'adminDashboard'])->name('admin.dashboard');

    Route::get('branch/dashboard', [HomeController::class,'branchDashboard'])->name('branch.dashboard');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');

});



/*
|--------------------------------------------------------------------------
| admin user
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/user/index/{role}', [UserController::class,'index'])->name('admin.user.index');

    Route::get('admin/user/show/{user}', [UserController::class,'show'])->name('admin.user.show');
;

});

/*
|--------------------------------------------------------------------------
| admin - branch
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/branch/stock/index/{branch}', [AdminBranchController::class,'stockIndex'])->name('admin.branch.stock.index');

    Route::get('admin/branch/create', [AdminBranchController::class,'branchCreate'])->name('admin.branch.create');

    Route::post('admin/branch/store', [AdminBranchController::class,'branchStore'])->name('admin.branch.store');

});

/*
|--------------------------------------------------------------------------
| admin - bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/bill/today_index/{branch}', [AdminBillController::class,'todayIndex'])->name('admin.bill.today_index');

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
| statistic
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/statistic/dashboard', [AdminStatisticController::class,'dashboard'])
    ->name('admin.statistic.dashboard');

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
| admin stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/stock/plate/index', [AdminStockController::class,'plateIndex'])
    ->name('admin.stock.plate.index');

    Route::get('admin/stock/show/{stock}', [AdminStockController::class,'show'])
    ->name('admin.stock.show');

    Route::get('admin/stock/transfer/create/{fromBranch}/{size}', [AdminStockController::class,'transferCreate'])
    ->name('admin.stock.transfer.create');
    
    Route::post('admin/stock/transfer/store', [AdminStockController::class,'transferStore'])
    ->name('admin.stock.transfer.store');
   
    Route::post('admin/stock/store', [AdminStockController::class,'store'])
    ->name('admin.stock.store');

});

/*
|--------------------------------------------------------------------------
| stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('stock/plate/received', [StockController::class,'plateReceived'])->name('stock.plate.received');

    Route::get('stock/plate/sold', [StockController::class,'plateSold'])->name('stock.plate.sold');

    Route::get('stock/plate/transferred', [StockController::class,'plateTransferred'])->name('stock.plate.transferred');
 
});

/*
|--------------------------------------------------------------------------
| statement
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('admin/statement/index/{branch}', [AdminStatementController::class,'index'])->name('admin.statement.index');

});


require __DIR__.'/auth.php';
