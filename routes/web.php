<?php


use App\Http\Controllers\Drink\DrinkStockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminBranchPermissionController;
use App\Http\Controllers\AdminPermissionRoleController;
use App\Http\Controllers\AdminStatementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBillController;
use App\Http\Controllers\AdminRoleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| welcome
|--------------------------------------------------------------------------
*/


Route::get('/', [HomeController::class, 'welcome']);


Route::group(['middleware' => ['auth', 'localization']], function () {

    Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])
        ->middleware('adminProfile')
        ->name('admin.dashboard');

    Route::get('branch/dashboard', [HomeController::class, 'branchDashboard'])
        ->middleware('branchProfile')
        ->name('branch.dashboard');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
});



/*
|--------------------------------------------------------------------------
| admin user
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/user/index', [UserController::class, 'index'])
        ->middleware('permission:admin.user.index')
        ->name('admin.user.index');

    Route::get('admin/user/show/{user}', [UserController::class, 'show'])
        ->middleware('permission:admin.user.show')
        ->name('admin.user.show');

    Route::get('admin/user/edit/{user}', [UserController::class, 'edit'])
        ->middleware('permission:admin.user.update')
        ->name('admin.user.edit');

    Route::post('admin/user/store', [UserController::class, 'store'])
        ->middleware('permission:admin.user.store')
        ->name('admin.user.store');

    Route::post('admin/user/update', [UserController::class, 'update'])
        ->middleware('permission:admin.user.update')
        ->name('admin.user.update');
});

/*
|--------------------------------------------------------------------------
| admin - branch
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/branch/show/{branch}', [AdminBranchController::class, 'branchShow'])
        ->middleware('permission:admin.branch.show')
        ->name('admin.branch.show');

    Route::get('admin/branch/index', [AdminBranchController::class, 'branchIndex'])
        ->middleware('permission:admin.branch.index')
        ->name('admin.branch.index');

    Route::post('admin/branch/store', [AdminBranchController::class, 'branchStore'])
        ->middleware('permission:admin.branch.store')
        ->name('admin.branch.store');

    Route::get('admin/branch/edit/{branch}', [AdminBranchController::class, 'branchEdit'])
        ->middleware('permission:admin.branch.update')
        ->name('admin.branch.edit');

    Route::post('admin/branch/update/{branch}', [AdminBranchController::class, 'branchUpdate'])
        ->middleware('permission:admin.branch.update')
        ->name('admin.branch.update');
});

/*
|--------------------------------------------------------------------------
| admin - branch permission
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {
    Route::get('admin/branch/permission/index/{branch}', [AdminBranchPermissionController::class, 'permissionIndex'])
        ->middleware('permission:admin.branch.permission.index')
        ->name('admin.branch.permission.index');

    Route::post('admin/branch/permission/update/{branch}', [AdminBranchPermissionController::class, 'permissionUpdate'])
        ->middleware('permission:admin.branch.permission.index')
        ->name('admin.branch.permission.update');
});


/*
|--------------------------------------------------------------------------
| admin role
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {

    Route::get('admin/role/index', [AdminRoleController::class, 'index'])
        ->middleware('permission:admin.role.index')
        ->name('admin.role.index');
});

/*
|--------------------------------------------------------------------------
| admin - permission role
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {

    Route::get('admin/permission_role/index/{role}', [AdminPermissionRoleController::class, 'index'])
        ->middleware('permission:admin.permission_role.index')
        ->name('admin.permission_role.index');

    Route::get('admin/permission_role/update/{role}', [AdminPermissionRoleController::class, 'update'])
        ->middleware('permission:admin.permission_role.index')
        ->name('admin.permission_role.update');
});



/*
|--------------------------------------------------------------------------
| admin - bill - plate
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/bill/plate/index/{branch}', [AdminBillController::class, 'plateIndex'])
        ->middleware('permission:admin.bill.plate.index')
        ->name('admin.bill.plate.index');

    Route::post('admin/bill/plate/search/{branch}', [AdminBillController::class, 'plateIndex'])
        ->middleware('permission:admin.bill.plate.index')
        ->name('admin.bill.plate.search');
});


/*
|--------------------------------------------------------------------------
| admin - bill - extra
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/bill/extra/index/{branch}', [AdminBillController::class, 'extraIndex'])
        ->middleware('permission:admin.bill.extra.index')
        ->name('admin.bill.extra.index');

    Route::post('admin/bill/extra/search/{branch}', [AdminBillController::class, 'extraIndex'])
        ->middleware('permission:admin.bill.extra.index')
        ->name('admin.bill.extra.search');
});


/*
|--------------------------------------------------------------------------
| Bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::post('bill/plate/store', [BillController::class, 'store'])
        ->middleware('permission:bill.plate.store')
        ->name('bill.plate.store');
});


/*
|--------------------------------------------------------------------------
| localization
|--------------------------------------------------------------------------
*/
Route::get('localization/store/{local}', [ProfileController::class, 'localizationStore'])
    ->name('localization.store');


/*
|--------------------------------------------------------------------------
| statement
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/statement/index/{branch}', [AdminStatementController::class, 'index'])
        ->middleware('permission:admin.statement.index')
        ->name('admin.statement.index');

    Route::post('admin/statement/search/{branch}', [AdminStatementController::class, 'index'])
        ->middleware('permission:admin.statement.index')
        ->name('admin.statement.search');
});


/*
|--------------------------------------------------------------------------
| items
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'localization']], function () {

    Route::get('item/index/{bill}', [ItemController::class, 'index'])
        ->middleware('permission:item.index')
        ->name('item.index');

    Route::post('item/failedprint/store', [ItemController::class, 'failedprintStore'])
        ->middleware('permission:item.failedprint.store')
        ->name('item.failedprint.store');

    Route::post('item/extra/store', [ItemController::class, 'extraStore'])
        ->middleware('permission:item.extra.store')
        ->name('item.extra.store');
});

/*
|--------------------------------------------------------------------------
| admin stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {


    Route::get('admin/stock/index/{branch}', [AdminStockController::class, 'stockIndex'])
        ->middleware('permission:admin.stock.index')
        ->name('admin.stock.index');

    Route::get('admin/stock/create/{branch}/{type}', [AdminStockController::class, 'stockCreate'])
        ->middleware('permission:admin.stock.store')
        ->name('admin.stock.create');

    Route::post('admin/stock/store/{branch}/{type}', [AdminStockController::class, 'stockStore'])
        ->middleware('permission:admin.stock.store')
        ->name('admin.stock.store');

    Route::get('admin/stock/transfer/create/{fromBranch}/{type}', [AdminStockController::class, 'transferCreate'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.create');

    Route::post('admin/stock/transfer/private_store', [AdminStockController::class, 'transferPrivateStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.private_store');

    Route::post('admin/stock/transfer/commercial_store', [AdminStockController::class, 'transferCommercialStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.commercial_store');

    Route::post('admin/stock/transfer/diplomatic_store', [AdminStockController::class, 'transferDiplomaticStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.diplomatic_store');

    Route::post('admin/stock/transfer/temporary_store', [AdminStockController::class, 'transferTemporaryStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.temporary_store');

    Route::post('admin/stock/transfer/export_store', [AdminStockController::class, 'transferExportStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.export_store');

    Route::post('admin/stock/transfer/specific_store', [AdminStockController::class, 'transferSpecificStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.specific_store');

    Route::post('admin/stock/transfer/learner_store', [AdminStockController::class, 'transferLearnerStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.learner_store');

    Route::post('admin/stock/transfer/government_store', [AdminStockController::class, 'transferGovernmentStore'])
        ->middleware('permission:admin.stock.transfer')
        ->name('admin.stock.transfer.government_store');
});


/*
|--------------------------------------------------------------------------
| drink stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'localization', 'drinkStockPermission']], function () {

    Route::get('drink_stock/create', [DrinkStockController::class, 'create'])->name('drink_stock.create');

    Route::get('drink_stock/index', [DrinkStockController::class, 'index'])->name('drink_stock.index');

    Route::post('drink_stock/store', [DrinkStockController::class, 'store'])->name('drink_stock.store');

    Route::get('drink_stock/edit/{drinkStock}', [DrinkStockController::class, 'edit'])->name('drink_stock.edit');

    Route::post('drink_stock/update/{drinkStock}', [DrinkStockController::class, 'update'])->name('drink_stock.update');
});

require __DIR__ . '/auth.php';
