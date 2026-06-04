<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\ProductionOrder;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\EcommerceOrder;
use App\Models\Client;
use App\Models\InventoryItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        // ── Quick Stats ────────────────────────────────────────────────
        $stats = [
            'active_orders'      => ProductionOrder::whereNotIn('stage', ['completed', 'cancelled'])->count(),
            'monthly_revenue'    => Invoice::where('status', 'paid')
                                        ->where('paid_at', '>=', $thisMonth)
                                        ->sum('total'),
            'staff_on_duty'      => Attendance::where('date', $today)
                                        ->where('status', 'present')
                                        ->count(),
            'total_staff'        => Employee::where('status', 'active')->count(),
            'pending_invoices'   => Invoice::whereIn('status', ['sent', 'viewed', 'partial'])->count(),
            'overdue_invoices'   => Invoice::where('status', '!=', 'paid')
                                        ->where('due_date', '<', $today)
                                        ->count(),
            'new_shop_orders'    => EcommerceOrder::where('status', 'pending')
                                        ->where('created_at', '>=', $today)
                                        ->count(),
            'low_stock_items'    => InventoryItem::where('status', 'low_stock')->count(),
        ];

        // ── Module Access (based on user role) ─────────────────────────
        $user = auth()->user();
        $modules = $this->getAccessibleModules($user);

        return view('dashboard', compact('stats', 'modules', 'user'));
    }

    public function stats()
    {
        // API endpoint for real-time stat refresh (AJAX)
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        return response()->json([
            'active_orders'   => ProductionOrder::whereNotIn('stage', ['completed', 'cancelled'])->count(),
            'monthly_revenue' => number_format(
                Invoice::where('status', 'paid')->where('paid_at', '>=', $thisMonth)->sum('total'), 2
            ),
            'staff_on_duty'   => Attendance::where('date', $today)->where('status', 'present')->count(),
            'pending_invoices'=> Invoice::whereIn('status', ['sent', 'viewed', 'partial'])->count(),
            'timestamp'       => now()->toIso8601String(),
        ]);
    }

    private function getAccessibleModules($user): array
    {
        $allModules = [
            ['id' => 'invoicing',   'name' => 'Smart Invoicing',      'route' => 'invoicing.index',   'icon' => '🧾', 'permission' => 'access-invoicing'],
            ['id' => 'production',  'name' => 'Order & Production',   'route' => 'production.index',  'icon' => '🏭', 'permission' => 'access-production'],
            ['id' => 'inventory',   'name' => 'Inventory',            'route' => 'inventory.index',   'icon' => '🧵', 'permission' => 'access-inventory'],
            ['id' => 'crm',         'name' => 'CRM',                  'route' => 'crm.index',         'icon' => '🤝', 'permission' => 'access-crm'],
            ['id' => 'projects',    'name' => 'Project Management',   'route' => 'projects.index',    'icon' => '📐', 'permission' => 'access-projects'],
            ['id' => 'ecommerce',   'name' => 'Ecommerce',            'route' => 'ecommerce.index',   'icon' => '🛍️', 'permission' => 'access-ecommerce'],
            ['id' => 'accounting',  'name' => 'Accounting',           'route' => 'accounting.index',  'icon' => '📊', 'permission' => 'access-accounting'],
            ['id' => 'hr',          'name' => 'HR & Payroll',         'route' => 'hr.index',          'icon' => '👔', 'permission' => 'access-hr'],
            ['id' => 'marketing',   'name' => 'Marketing',            'route' => 'marketing.index',   'icon' => '📣', 'permission' => 'access-marketing'],
            ['id' => 'analytics',   'name' => 'Analytics',            'route' => 'analytics.index',   'icon' => '📈', 'permission' => 'access-analytics'],
            ['id' => 'admin',       'name' => 'Super Admin',          'route' => 'admin.index',       'icon' => '🔐', 'permission' => 'role:super-admin'],
            ['id' => 'slack',       'name' => 'Slack',                'route' => null,                'icon' => '💬', 'permission' => null, 'external' => 'https://slack.com'],
        ];

        return array_filter($allModules, function ($module) use ($user) {
            if ($module['permission'] === null) return true;
            if (str_starts_with($module['permission'], 'role:')) {
                return $user->role->name === substr($module['permission'], 5);
            }
            return $user->can($module['permission']);
        });
    }
}
