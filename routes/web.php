<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoicingController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CrmController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| My Perfect Stitch — Operations Suite Routes
|--------------------------------------------------------------------------
*/

// ── Authentication ─────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protected Routes ───────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (App Suite Home)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ── 01. Smart Invoicing ─────────────────────────────────────────────────
    Route::prefix('invoicing')->name('invoicing.')->middleware('can:access-invoicing')->group(function () {
        Route::get('/',                [InvoicingController::class, 'index'])->name('index');
        Route::get('/create',          [InvoicingController::class, 'create'])->name('create');
        Route::post('/',               [InvoicingController::class, 'store'])->name('store');
        Route::get('/{invoice}',       [InvoicingController::class, 'show'])->name('show');
        Route::get('/{invoice}/edit',  [InvoicingController::class, 'edit'])->name('edit');
        Route::put('/{invoice}',       [InvoicingController::class, 'update'])->name('update');
        Route::delete('/{invoice}',    [InvoicingController::class, 'destroy'])->name('destroy');
        Route::post('/{invoice}/send', [InvoicingController::class, 'send'])->name('send');
        Route::get('/{invoice}/pdf',   [InvoicingController::class, 'generatePdf'])->name('pdf');
        Route::post('/{invoice}/mark-paid', [InvoicingController::class, 'markPaid'])->name('mark-paid');
        Route::get('/quotes/create',   [InvoicingController::class, 'createQuote'])->name('quotes.create');
    });

    // ── 02. Order & Production ──────────────────────────────────────────────
    Route::prefix('production')->name('production.')->middleware('can:access-production')->group(function () {
        Route::get('/',                  [ProductionController::class, 'index'])->name('index');
        Route::get('/board',             [ProductionController::class, 'kanban'])->name('board');
        Route::get('/create',            [ProductionController::class, 'create'])->name('create');
        Route::post('/',                 [ProductionController::class, 'store'])->name('store');
        Route::get('/{order}',           [ProductionController::class, 'show'])->name('show');
        Route::put('/{order}/stage',     [ProductionController::class, 'updateStage'])->name('update-stage');
        Route::post('/{order}/qc',       [ProductionController::class, 'qcCheckpoint'])->name('qc');
        Route::put('/{order}/assign',    [ProductionController::class, 'assignStaff'])->name('assign');
        Route::get('/calendar',          [ProductionController::class, 'calendar'])->name('calendar');
    });

    // ── 03. Inventory ───────────────────────────────────────────────────────
    Route::prefix('inventory')->name('inventory.')->middleware('can:access-inventory')->group(function () {
        Route::get('/',                      [InventoryController::class, 'index'])->name('index');
        Route::get('/create',                [InventoryController::class, 'create'])->name('create');
        Route::post('/',                     [InventoryController::class, 'store'])->name('store');
        Route::get('/{item}',                [InventoryController::class, 'show'])->name('show');
        Route::put('/{item}',                [InventoryController::class, 'update'])->name('update');
        Route::delete('/{item}',             [InventoryController::class, 'destroy'])->name('destroy');
        Route::post('/{item}/restock',       [InventoryController::class, 'restock'])->name('restock');
        Route::post('/{item}/deduct',        [InventoryController::class, 'deduct'])->name('deduct');
        Route::get('/alerts/low-stock',      [InventoryController::class, 'lowStockAlerts'])->name('low-stock');
        Route::get('/reports/usage',         [InventoryController::class, 'usageReport'])->name('usage-report');
    });

    // ── 04. CRM ─────────────────────────────────────────────────────────────
    Route::prefix('crm')->name('crm.')->middleware('can:access-crm')->group(function () {
        Route::get('/',                      [CrmController::class, 'index'])->name('index');
        Route::get('/clients/create',        [CrmController::class, 'createClient'])->name('clients.create');
        Route::post('/clients',              [CrmController::class, 'storeClient'])->name('clients.store');
        Route::get('/clients/{client}',      [CrmController::class, 'showClient'])->name('clients.show');
        Route::get('/clients/{client}/edit', [CrmController::class, 'editClient'])->name('clients.edit');
        Route::put('/clients/{client}',      [CrmController::class, 'updateClient'])->name('clients.update');
        Route::delete('/clients/{client}',   [CrmController::class, 'destroyClient'])->name('clients.destroy');
        Route::get('/pipeline',              [CrmController::class, 'pipeline'])->name('pipeline');
        Route::post('/interactions',         [CrmController::class, 'logInteraction'])->name('interactions.store');
        Route::get('/reports',               [CrmController::class, 'reports'])->name('reports');
    });

    // ── 05. Project Management ──────────────────────────────────────────────
    Route::prefix('projects')->name('projects.')->middleware('can:access-projects')->group(function () {
        Route::get('/',                          [ProjectController::class, 'index'])->name('index');
        Route::get('/create',                    [ProjectController::class, 'create'])->name('create');
        Route::post('/',                         [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}',                 [ProjectController::class, 'show'])->name('show');
        Route::put('/{project}',                 [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}',              [ProjectController::class, 'destroy'])->name('destroy');
        Route::post('/{project}/milestones',     [ProjectController::class, 'addMilestone'])->name('milestones.store');
        Route::put('/milestones/{milestone}',    [ProjectController::class, 'updateMilestone'])->name('milestones.update');
        Route::post('/{project}/contractors',    [ProjectController::class, 'assignContractor'])->name('contractors.assign');
        Route::post('/{project}/site-visits',    [ProjectController::class, 'logSiteVisit'])->name('site-visits.store');
        Route::get('/{project}/timeline',        [ProjectController::class, 'timeline'])->name('timeline');
    });

    // ── 06. Ecommerce ───────────────────────────────────────────────────────
    Route::prefix('ecommerce')->name('ecommerce.')->middleware('can:access-ecommerce')->group(function () {
        Route::get('/',                       [EcommerceController::class, 'index'])->name('index');
        Route::get('/products',               [EcommerceController::class, 'products'])->name('products');
        Route::get('/products/create',        [EcommerceController::class, 'createProduct'])->name('products.create');
        Route::post('/products',              [EcommerceController::class, 'storeProduct'])->name('products.store');
        Route::get('/products/{product}/edit',[EcommerceController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{product}',     [EcommerceController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{product}',  [EcommerceController::class, 'destroyProduct'])->name('products.destroy');
        Route::get('/orders',                 [EcommerceController::class, 'orders'])->name('orders');
        Route::get('/orders/{order}',         [EcommerceController::class, 'showOrder'])->name('orders.show');
        Route::put('/orders/{order}/status',  [EcommerceController::class, 'updateOrderStatus'])->name('orders.update-status');
        Route::get('/categories',             [EcommerceController::class, 'categories'])->name('categories');
        Route::get('/customers',              [EcommerceController::class, 'customers'])->name('customers');
    });

    // ── 07. Accounting ──────────────────────────────────────────────────────
    Route::prefix('accounting')->name('accounting.')->middleware('can:access-accounting')->group(function () {
        Route::get('/',                          [AccountingController::class, 'index'])->name('index');
        Route::get('/income',                    [AccountingController::class, 'income'])->name('income');
        Route::get('/expenses',                  [AccountingController::class, 'expenses'])->name('expenses');
        Route::post('/expenses',                 [AccountingController::class, 'storeExpense'])->name('expenses.store');
        Route::get('/ledger',                    [AccountingController::class, 'ledger'])->name('ledger');
        Route::get('/reports/monthly',           [AccountingController::class, 'monthlyReport'])->name('reports.monthly');
        Route::get('/reports/zra',               [AccountingController::class, 'zraReport'])->name('reports.zra');
        Route::get('/reports/profit-loss',       [AccountingController::class, 'profitLoss'])->name('reports.profit-loss');
        Route::get('/suppliers',                 [AccountingController::class, 'suppliers'])->name('suppliers');
        Route::post('/suppliers',                [AccountingController::class, 'storeSupplier'])->name('suppliers.store');
        Route::get('/bank-reconciliation',       [AccountingController::class, 'bankReconciliation'])->name('bank-reconciliation');
    });

    // ── 08. HR & Payroll ────────────────────────────────────────────────────
    Route::prefix('hr')->name('hr.')->middleware('can:access-hr')->group(function () {
        Route::get('/',                          [HrController::class, 'index'])->name('index');
        Route::get('/employees',                 [HrController::class, 'employees'])->name('employees');
        Route::get('/employees/create',          [HrController::class, 'createEmployee'])->name('employees.create');
        Route::post('/employees',                [HrController::class, 'storeEmployee'])->name('employees.store');
        Route::get('/employees/{employee}',      [HrController::class, 'showEmployee'])->name('employees.show');
        Route::put('/employees/{employee}',      [HrController::class, 'updateEmployee'])->name('employees.update');
        Route::get('/attendance',                [HrController::class, 'attendance'])->name('attendance');
        Route::post('/attendance/check-in',      [HrController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('/attendance/check-out',     [HrController::class, 'checkOut'])->name('attendance.check-out');
        Route::get('/leave',                     [HrController::class, 'leave'])->name('leave');
        Route::post('/leave',                    [HrController::class, 'applyLeave'])->name('leave.apply');
        Route::put('/leave/{leave}/approve',     [HrController::class, 'approveLeave'])->name('leave.approve');
        Route::get('/payroll',                   [HrController::class, 'payroll'])->name('payroll');
        Route::post('/payroll/run',              [HrController::class, 'runPayroll'])->name('payroll.run');
        Route::get('/payroll/{month}/slips',     [HrController::class, 'payslips'])->name('payroll.slips');
        Route::get('/departments',               [HrController::class, 'departments'])->name('departments');
    });

    // ── 09. Marketing ───────────────────────────────────────────────────────
    Route::prefix('marketing')->name('marketing.')->middleware('can:access-marketing')->group(function () {
        Route::get('/',                           [MarketingController::class, 'index'])->name('index');
        Route::get('/campaigns',                  [MarketingController::class, 'campaigns'])->name('campaigns');
        Route::get('/campaigns/create',           [MarketingController::class, 'createCampaign'])->name('campaigns.create');
        Route::post('/campaigns',                 [MarketingController::class, 'storeCampaign'])->name('campaigns.store');
        Route::get('/campaigns/{campaign}',       [MarketingController::class, 'showCampaign'])->name('campaigns.show');
        Route::put('/campaigns/{campaign}',       [MarketingController::class, 'updateCampaign'])->name('campaigns.update');
        Route::get('/social-scheduler',           [MarketingController::class, 'socialScheduler'])->name('social-scheduler');
        Route::post('/social-posts',              [MarketingController::class, 'schedulePost'])->name('social-posts.store');
        Route::get('/events',                     [MarketingController::class, 'events'])->name('events');
        Route::post('/events',                    [MarketingController::class, 'storeEvent'])->name('events.store');
        Route::get('/leads',                      [MarketingController::class, 'leads'])->name('leads');
        Route::post('/leads',                     [MarketingController::class, 'storeLead'])->name('leads.store');
    });

    // ── 10. Analytics ───────────────────────────────────────────────────────
    Route::prefix('analytics')->name('analytics.')->middleware('can:access-analytics')->group(function () {
        Route::get('/',                  [AnalyticsController::class, 'index'])->name('index');
        Route::get('/revenue',           [AnalyticsController::class, 'revenue'])->name('revenue');
        Route::get('/production',        [AnalyticsController::class, 'productionMetrics'])->name('production');
        Route::get('/clients',           [AnalyticsController::class, 'clientMetrics'])->name('clients');
        Route::get('/staff',             [AnalyticsController::class, 'staffPerformance'])->name('staff');
        Route::get('/inventory',         [AnalyticsController::class, 'inventoryTrends'])->name('inventory');
        Route::get('/export/{report}',   [AnalyticsController::class, 'export'])->name('export');

        // API endpoints for chart data
        Route::get('/api/revenue-chart',     [AnalyticsController::class, 'revenueChartData'])->name('api.revenue');
        Route::get('/api/orders-chart',      [AnalyticsController::class, 'ordersChartData'])->name('api.orders');
        Route::get('/api/top-clients',       [AnalyticsController::class, 'topClientsData'])->name('api.top-clients');
    });

    // ── 11. Super Admin ─────────────────────────────────────────────────────
    Route::prefix('admin')->name('admin.')->middleware('role:super-admin')->group(function () {
        Route::get('/',                          [AdminController::class, 'index'])->name('index');
        Route::get('/users',                     [AdminController::class, 'users'])->name('users');
        Route::get('/users/create',              [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users',                    [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit',         [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}',              [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}',           [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/roles',                     [AdminController::class, 'roles'])->name('roles');
        Route::post('/roles',                    [AdminController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}/permissions',  [AdminController::class, 'updatePermissions'])->name('roles.permissions');
        Route::get('/audit-logs',                [AdminController::class, 'auditLogs'])->name('audit-logs');
        Route::get('/system',                    [AdminController::class, 'systemSettings'])->name('system');
        Route::put('/system',                    [AdminController::class, 'updateSystemSettings'])->name('system.update');
        Route::get('/database',                  [AdminController::class, 'databaseStatus'])->name('database');
        Route::post('/backup',                   [AdminController::class, 'createBackup'])->name('backup');
    });

    // ── API — Shared Data Endpoints ─────────────────────────────────────────
    Route::prefix('api/v1')->middleware('throttle:api')->group(function () {
        Route::get('/dashboard/stats',  [DashboardController::class, 'stats']);
        Route::get('/clients/search',   [CrmController::class, 'search']);
        Route::get('/products/search',  [EcommerceController::class, 'searchProducts']);
        Route::get('/staff/search',     [HrController::class, 'searchStaff']);
    });

});
