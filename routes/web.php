<?php

use App\Http\Controllers\Drink\DrinkStockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminBranchPermissionController;
use App\Http\Controllers\AdminUserPermissionController;
use App\Http\Controllers\AdminPermissionRoleController;
use App\Http\Controllers\AdminStatementController;
use App\Http\Controllers\AdminSupplierController;
use App\Http\Controllers\AdminMainstockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestBillController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBillController;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminImpersonateController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| welcome
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'welcome']);

Route::group(['middleware' => ['auth', 'localization']], function () {

    Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])
        ->middleware(['impersonate', 'adminProfile'])
        ->name('admin.dashboard');

    Route::get('branch/dashboard', [HomeController::class, 'branchDashboard'])
        ->middleware(['impersonate', 'branchProfile'])
        ->name('branch.dashboard');

    Route::get('profile', [ProfileController::class, 'show'])
        ->middleware('impersonate')
        ->name('profile');

    Route::get('plate/sale_history/{date}', [ProfileController::class, 'plateSaleHistory'])
        ->middleware('impersonate')
        ->name('plate.sale_history');

    Route::get('extra/sale_history/{date}', [ProfileController::class, 'extraSaleHistory'])
        ->middleware('impersonate')
        ->name('extra.sale_history');

    Route::get('test', [HomeController::class, 'testDashbord'])->middleware(['impersonate', 'branchProfile']);
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
        ->middleware('permission:admin.branch.print')
        ->name('admin.branch.print');

    Route::get('admin/branch/show/{branch}', [AdminBranchController::class, 'branchShow'])
        ->middleware('permission:admin.branch.show')
        ->name('admin.branch.show');

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
        ->middleware('permission:admin.role')
        ->name('admin.role.index');
});

/*
|--------------------------------------------------------------------------
| admin - permission role
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/permission_role/index/{role}', [AdminPermissionRoleController::class, 'index'])
        ->middleware('permission:admin.role')
        ->name('admin.permission_role.index');

    Route::post('admin/permission_role/update/{role}', [AdminPermissionRoleController::class, 'update'])
        ->middleware('permission:admin.role')
        ->name('admin.permission_role.update');
});


/*
|--------------------------------------------------------------------------
| admin - bill 
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/bill/show/{bill}', [AdminBillController::class, 'show'])
        ->middleware('permission:admin.bill.show')
        ->name('admin.bill.show');

    Route::get('admin/bill/delete/{bill}', [AdminBillController::class, 'delete'])
        ->middleware('permission:admin.bill.delete')
        ->name('admin.bill.delete');
});


/*
|--------------------------------------------------------------------------
| admin - bill - plate
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::match(['get', 'post'], 'admin/bill/plate/index/{branch}', [AdminBillController::class, 'plateIndex'])
        ->middleware('permission:admin.bill.plate.index')
        ->name('admin.bill.plate.index');
});


/*
|--------------------------------------------------------------------------
| admin - bill - extra
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::match(['get', 'post'], 'admin/bill/extra/index/{branch}', [AdminBillController::class, 'extraIndex'])
        ->middleware('permission:admin.bill.extra.index')
        ->name('admin.bill.extra.index');
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
| admin Item
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/item/delete/{item}', [AdminItemController::class, 'delete'])
        ->middleware('permission:admin.item.delete')
        ->name('admin.item.delete');
});


/*
|--------------------------------------------------------------------------
| admin supplier
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/supplier/index', [AdminSupplierController::class, 'index'])
        ->middleware('permission:admin.supplier.index')
        ->name('admin.supplier.index');

    Route::get('admin/supplier/edit/{supplier}', [AdminSupplierController::class, 'edit'])
        ->middleware('permission:admin.supplier.update')
        ->name('admin.supplier.edit');

    Route::post('admin/supplier/store', [AdminSupplierController::class, 'store'])
        ->middleware('permission:admin.supplier.store')
        ->name('admin.supplier.store');

    Route::post('admin/supplier/update/{supplier}', [AdminSupplierController::class, 'update'])
        ->middleware('permission:admin.supplier.update')
        ->name('admin.supplier.update');
});

/*
|--------------------------------------------------------------------------
| admin mainstock
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'adminProfile']], function () {

    Route::get('admin/mainstock/index', [AdminMainstockController::class, 'index'])
        ->middleware('permission:admin.mainstock.index')
        ->name('admin.mainstock.index');

    Route::get('admin/mainstock/edit/{mainstock}', [AdminMainstockController::class, 'edit'])
        ->middleware('permission:admin.mainstock.update')
        ->name('admin.mainstock.edit');

    Route::post('admin/mainstock/store', [AdminMainstockController::class, 'store'])
        ->middleware('permission:admin.mainstock.store')
        ->name('admin.mainstock.store');

    Route::post('admin/mainstock/update/{mainstock}', [AdminMainstockController::class, 'update'])
        ->middleware('permission:admin.mainstock.update')
        ->name('admin.mainstock.update');
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
Route::group(['middleware' => ['auth', 'impersonate', 'branchProfile']], function () {

    Route::post('bill/plate/store', [BillController::class, 'store'])
        ->name('bill.plate.store');

    Route::post('bill/plate/update/{bill}', [BillController::class, 'update'])
        ->name('bill.plate.update');
});

/*
|--------------------------------------------------------------------------
| Bill
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'impersonate', 'branchProfile']], function () {

    Route::post('test/bill/plate/store', [TestBillController::class, 'storeBill'])
        ->name('test.bill.plate.store');
});

/*
|--------------------------------------------------------------------------
| items
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'impersonate', 'branchProfile', 'localization']], function () {

    Route::get('item/show/{bill}', [ItemController::class, 'show'])
        ->name('item.show');

    Route::post('item/price_update/{item}', [ItemController::class, 'priceUpdate'])
        ->name('item.price_update');

    Route::post('item/failedprint/store', [ItemController::class, 'failedprintStore'])
        ->name('item.failedprint.store');

    Route::post('item/extra/store', [ItemController::class, 'extraStore'])
        ->name('item.extra.store');



    Route::post('item/printing/store', [ItemController::class, 'pritingStore'])
        ->name('item.printing.store');
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
