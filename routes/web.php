<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminPermissionController;
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


Route::get('/', [HomeController::class, 'welcome']);


Route::group(['middleware' => ['auth', 'localization']], function () {

    Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('branch/dashboard', [HomeController::class, 'branchDashboard'])->name('branch.dashboard');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
});



/*
|--------------------------------------------------------------------------
| admin user
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/user/index', [UserController::class, 'index'])->name('admin.user.index');

    Route::get('admin/user/show/{user}', [UserController::class, 'show'])->name('admin.user.show');

    Route::get('admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');

    Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.user.store');

    Route::post('admin/user/update', [UserController::class, 'update'])->name('admin.user.update');
});

/*
|--------------------------------------------------------------------------
| admin - branch
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/branch/stock/index/{branch}', [AdminBranchController::class, 'stockIndex'])->name('admin.branch.stock.index');

    Route::get('admin/branch/show/{branch}', [AdminBranchController::class, 'branchShow'])->name('admin.branch.show');

    Route::get('admin/branch/index', [AdminBranchController::class, 'branchIndex'])->name('admin.branch.index');

    Route::post('admin/branch/store', [AdminBranchController::class, 'branchStore'])->name('admin.branch.store');

});

/*
|--------------------------------------------------------------------------
| admin - branch
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/branch/permission/index/{branch}', [AdminPermissionController::class, 'branchPermissionIndex'])->name('admin.branch.permission.index');
    
    Route::post('admin/branch/permission/update/{branch}', [AdminPermissionController::class, 'branchPermissionUpdate'])->name('admin.branch.permission.update');
});


/*
|--------------------------------------------------------------------------
| admin - bill - plate
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/bill/plate/index/{branch}', [AdminBillController::class, 'plateIndex'])->name('admin.bill.plate.index');

    Route::post('admin/bill/plate/search/{branch}', [AdminBillController::class, 'plateIndex'])->name('admin.bill.plate.search');
});


/*
|--------------------------------------------------------------------------
| admin - bill - extra
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/bill/extra/index/{branch}', [AdminBillController::class, 'extraIndex'])->name('admin.bill.extra.index');

    Route::post('admin/bill/extra/search/{branch}', [AdminBillController::class, 'extraIndex'])->name('admin.bill.extra.search');
});


/*
|--------------------------------------------------------------------------
| Bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::post('bill/store', [BillController::class, 'store'])->name('bill.store');
});


/*
|--------------------------------------------------------------------------
| localization
|--------------------------------------------------------------------------
*/
Route::get('localization/store/{local}', [ProfileController::class, 'localizationStore'])->name('localization.store');


/*
|--------------------------------------------------------------------------
| statement
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/statement/index/{branch}', [AdminStatementController::class, 'index'])->name('admin.statement.index');

    Route::post('admin/statement/search/{branch}', [AdminStatementController::class, 'index'])->name('admin.statement.search');
    
});


/*
|--------------------------------------------------------------------------
| items
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth','localization']], function () {

    Route::get('item/index/{bill}', [ItemController::class, 'index'])->name('item.index');

    Route::post('item/failedprint/store', [ItemController::class, 'failedprintStore'])->name('item.failedprint.store');

    Route::post('item/extra/store', [ItemController::class, 'extraStore'])->name('item.extra.store');
});

/*
|--------------------------------------------------------------------------
| admin stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/stock/show/{stock}', [AdminStockController::class, 'show'])
        ->name('admin.stock.show');

    Route::get('admin/stock/transfer/create/{fromBranch}/{size}', [AdminStockController::class, 'transferCreate'])
        ->name('admin.stock.transfer.create');

    Route::post('admin/stock/transfer/store', [AdminStockController::class, 'transferStore'])
        ->name('admin.stock.transfer.store');

    Route::post('admin/stock/store', [AdminStockController::class, 'store'])
        ->name('admin.stock.store');
});

/*
|--------------------------------------------------------------------------
| stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'localization']], function () {

    Route::get('stock/plate/dashboard', [StockController::class, 'plateDashboard'])->name('stock.plate.dashboard');

    Route::get('stock/plate/received', [StockController::class, 'plateReceived'])->name('stock.plate.received');

    Route::get('stock/plate/sold', [StockController::class, 'plateSold'])->name('stock.plate.sold');

    Route::get('stock/plate/transferred', [StockController::class, 'plateTransferred'])->name('stock.plate.transferred');
});



require __DIR__ . '/auth.php';
