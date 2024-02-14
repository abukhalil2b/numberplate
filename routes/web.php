<?php


use App\Http\Controllers\Drink\DrinkStockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminBranchPermissionController;
use App\Http\Controllers\AdminUserPermissionController;
use App\Http\Controllers\AdminPermissionRoleController;
use App\Http\Controllers\AdminStatementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBillController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminImpersonateController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| welcome
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'welcome']);

Route::group(['middleware' => ['auth', 'impersonate', 'localization']], function () {

    Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])
        ->middleware('adminProfile')
        ->name('admin.dashboard');

    Route::get('branch/dashboard', [HomeController::class, 'branchDashboard'])
        ->middleware('branchProfile')
        ->name('branch.dashboard');

    Route::get('profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::get('plate/sale_history/{date}', [ProfileController::class, 'plateSaleHistory'])
        ->name('plate.sale_history');

    Route::get('extra/sale_history/{date}', [ProfileController::class, 'extraSaleHistory'])
        ->name('extra.sale_history');
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
Route::group(['middleware' => ['auth', 'adminProfile', 'localization']], function () {
    Route::get('admin/branch/print', [AdminBranchController::class, 'branchPrint'])
        ->middleware('permission:admin.branch.show')
        ->name('admin.branch.print');

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
Route::group(['middleware' => ['auth', 'adminProfile', 'localization']], function () {
    Route::get('admin/branch/permission/index/{branch}', [AdminBranchPermissionController::class, 'permissionIndex'])
        ->middleware('permission:admin.branch.permission.index')
        ->name('admin.branch.permission.index');

    Route::post('admin/branch/permission/update/{branch}', [AdminBranchPermissionController::class, 'permissionUpdate'])
        ->middleware('permission:admin.branch.permission.index')
        ->name('admin.branch.permission.update');

    Route::get('admin/branch/manage_permission/index/{user}', [AdminBranchPermissionController::class, 'manageBranchesIndex'])
        ->middleware('permission:admin.branch.manage_permission.index')
        ->name('admin.branch.manage_permission.index');

    Route::post('admin/branch/manage_permission/update/{user}', [AdminBranchPermissionController::class, 'manageBranchesUpdate'])
        ->middleware('permission:admin.branch.manage_permission.update')
        ->name('admin.branch.manage_permission.update');
});


/*
|--------------------------------------------------------------------------
| admin - user permission
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {
    Route::get('admin/user/role_with_permissions/index/{user}', [AdminUserPermissionController::class, 'roleWithPermissions'])
        ->name('admin.user.role_with_permissions.index');
});


/*
|--------------------------------------------------------------------------
| admin role
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/role/index', [AdminRoleController::class, 'index'])
        ->middleware('permission:admin.role.index')
        ->name('admin.role.index');
});

/*
|--------------------------------------------------------------------------
| admin - permission role
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/permission_role/index/{role}', [AdminPermissionRoleController::class, 'index'])
        ->middleware('permission:admin.permission_role.index')
        ->name('admin.permission_role.index');

    Route::post('admin/permission_role/update/{role}', [AdminPermissionRoleController::class, 'update'])
        ->middleware('permission:admin.permission_role.index')
        ->name('admin.permission_role.update');
});



/*
|--------------------------------------------------------------------------
| admin - bill - plate
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

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
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/bill/extra/index/{branch}', [AdminBillController::class, 'extraIndex'])
        ->middleware('permission:admin.bill.extra.index')
        ->name('admin.bill.extra.index');

    Route::post('admin/bill/extra/search/{branch}', [AdminBillController::class, 'extraIndex'])
        ->middleware('permission:admin.bill.extra.index')
        ->name('admin.bill.extra.search');
});

/*
|--------------------------------------------------------------------------
| admin statement
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/statement/index/{branch}', [AdminStatementController::class, 'index'])
        ->middleware('permission:admin.statement.index')
        ->name('admin.statement.index');

    Route::post('admin/statement/search/{branch}', [AdminStatementController::class, 'index'])
        ->middleware('permission:admin.statement.index')
        ->name('admin.statement.search');
});


/*
|--------------------------------------------------------------------------
| admin stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile', 'localization']], function () {

    Route::get('admin/stock/index/{branch}', [AdminStockController::class, 'stockIndex'])
        ->middleware('permission:admin.stock.index')
        ->name('admin.stock.index');

    Route::get('admin/stock/create/{branch}/{type}', [AdminStockController::class, 'stockCreate'])
        ->middleware('permission:admin.stock.store')
        ->name('admin.stock.create');

    Route::post('admin/stock/store/{branch}/{type}', [AdminStockController::class, 'stockStore'])
        ->middleware('permission:admin.stock.store')
        ->name('admin.stock.store');
});

/*
|--------------------------------------------------------------------------
| plate stock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'impersonate', 'branchProfile', 'localization']], function () {
    Route::get('stock/transfer/create/{fromBranch}/{type}', [StockController::class, 'transferCreate'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.create');

    Route::post('stock/transfer/private_store', [StockController::class, 'transferPrivateStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.private_store');

    Route::post('stock/transfer/commercial_store', [StockController::class, 'transferCommercialStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.commercial_store');

    Route::post('stock/transfer/diplomatic_store', [StockController::class, 'transferDiplomaticStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.diplomatic_store');

    Route::post('stock/transfer/temporary_store', [StockController::class, 'transferTemporaryStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.temporary_store');

    Route::post('stock/transfer/export_store', [StockController::class, 'transferExportStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.export_store');

    Route::post('stock/transfer/specific_store', [StockController::class, 'transferSpecificStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.specific_store');

    Route::post('stock/transfer/learner_store', [StockController::class, 'transferLearnerStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.learner_store');

    Route::post('stock/transfer/government_store', [StockController::class, 'transferGovernmentStore'])
        ->middleware('permission:stock.transfer')
        ->name('stock.transfer.government_store');
});

/*
|--------------------------------------------------------------------------
| Bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'impersonate','branchProfile']], function () {

    Route::post('bill/plate/store', [BillController::class, 'store'])
        ->name('bill.plate.store');

    Route::get('bill/plate/delete/{bill}', [BillController::class, 'delete'])
        ->name('bill.plate.delete');

    Route::post('bill/plate/update/{bill}', [BillController::class, 'update'])
        ->name('bill.plate.update');
});



/*
|--------------------------------------------------------------------------
| items
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'impersonate', 'branchProfile', 'localization']], function () {

    Route::get('item/index/{bill}', [ItemController::class, 'index'])
        ->name('item.index');

    Route::post('item/price_update/{item}', [ItemController::class, 'priceUpdate'])
        ->name('item.price_update');

    Route::post('item/failedprint/store', [ItemController::class, 'failedprintStore'])
        ->name('item.failedprint.store');

    Route::post('item/extra/store', [ItemController::class, 'extraStore'])
        ->name('item.extra.store');

    Route::get('item/extra/delete/{item}', [ItemController::class, 'extraDelete'])
        ->name('item.extra.delete');
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

/*
|--------------------------------------------------------------------------
| localization
|--------------------------------------------------------------------------
*/
Route::get('localization/store/{local}', [ProfileController::class, 'localizationStore'])
    ->middleware('impersonate')
    ->name('localization.store');

/*
|--------------------------------------------------------------------------
| Impersonate
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'impersonate'])->group(function () {

    Route::get('admin/impersonate/enable/{user}', [AdminImpersonateController::class, 'enableImpersonate'])
        ->middleware('permission:admin.impersonate')
        ->name('admin.impersonate.enable');

    Route::get('admin/impersonate/disable', [AdminImpersonateController::class, 'disableImpersonate'])
        ->name('admin.impersonate.disable');
});

require __DIR__ . '/auth.php';
