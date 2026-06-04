<?php
/*
|--------------------------------------------------------------------------
| My Perfect Stitch — Master Database Schema
| Single MySQL database shared across all 12 modules
|--------------------------------------------------------------------------
| Run: php artisan migrate
|--------------------------------------------------------------------------
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─────────────────────────────────────────────────────────────────
        // USERS & ROLES (Super Admin / Auth)
        // ─────────────────────────────────────────────────────────────────
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();                   // super-admin, manager, production, sales, accounts, hr
            $table->string('display_name');
            $table->json('permissions')->nullable();            // module-level permissions
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('department')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('action');                           // created, updated, deleted, login
            $table->string('module');                           // invoicing, crm, hr, etc.
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at');
        });

        // ─────────────────────────────────────────────────────────────────
        // CRM — Clients & Interactions
        // ─────────────────────────────────────────────────────────────────
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['institutional', 'corporate', 'individual', 'retail'])->default('corporate');
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->default('Lusaka');
            $table->string('country')->default('Zambia');
            $table->enum('status', ['lead', 'prospect', 'active', 'dormant', 'lost'])->default('lead');
            $table->enum('tier', ['standard', 'vip', 'enterprise'])->default('standard');
            $table->text('notes')->nullable();
            $table->string('referral_source')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->decimal('lifetime_value', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('client_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('type', ['call', 'email', 'meeting', 'whatsapp', 'site_visit', 'note']);
            $table->string('subject');
            $table->text('notes')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // INVOICING — Quotes, Invoices, Payments
        // ─────────────────────────────────────────────────────────────────
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();         // MPS-INV-2026-0001
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('created_by')->constrained('users');
            $table->enum('type', ['quote', 'proforma', 'invoice', 'receipt', 'credit_note'])->default('invoice');
            $table->enum('status', ['draft', 'sent', 'viewed', 'partial', 'paid', 'overdue', 'cancelled'])->default('draft');
            $table->enum('vertical', ['bags', 'furniture', 'interiors', 'mixed'])->nullable();
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_percent', 5, 2)->default(16);  // ZRA VAT 16%
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance_due', 12, 2)->default(0);
            $table->string('currency')->default('ZMW');
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->string('description');
            $table->integer('quantity')->default(1);
            $table->string('unit')->default('pcs');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('total', 12, 2);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->foreignId('recorded_by')->constrained('users');
            $table->decimal('amount', 12, 2);
            $table->string('currency')->default('ZMW');
            $table->enum('method', ['cash', 'bank_transfer', 'mobile_money', 'cheque', 'card'])->default('bank_transfer');
            $table->string('reference')->nullable();            // Transaction ID / cheque no
            $table->date('payment_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // INVENTORY — Materials & Stock
        // ─────────────────────────────────────────────────────────────────
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                             // Fabrics, Hardware, Foam, Timber, etc.
            $table->enum('vertical', ['bags', 'furniture', 'interiors', 'shared']);
            $table->string('color_code')->nullable();
            $table->timestamps();
        });

        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('inventory_categories');
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->string('unit');                             // metres, kg, rolls, pcs
            $table->decimal('quantity', 10, 2)->default(0);
            $table->decimal('min_quantity', 10, 2)->default(0);// Reorder point
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->string('supplier')->nullable();
            $table->string('location')->nullable();             // Storage shelf/bin
            $table->enum('status', ['in_stock', 'low_stock', 'out_of_stock'])->default('in_stock');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('inventory_items');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('type', ['restock', 'deduction', 'adjustment', 'damage', 'return']);
            $table->decimal('quantity', 10, 2);
            $table->decimal('quantity_before', 10, 2);
            $table->decimal('quantity_after', 10, 2);
            $table->string('reference')->nullable();            // Order ID, PO number
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // ORDER & PRODUCTION
        // ─────────────────────────────────────────────────────────────────
        Schema::create('production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();           // MPS-ORD-2026-0001
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices');
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->enum('vertical', ['bags', 'furniture', 'interiors']);
            $table->string('product_type');                     // backpack, sofa, fit-out
            $table->text('brief')->nullable();
            $table->integer('quantity')->default(1);
            $table->enum('stage', [
                'brief',        // 1. Brief & Feasibility
                'design',       // 2. Consultation & Design
                'production',   // 3. Production & QC
                'delivery',     // 4. Delivery & Execution
                'completed',
                'cancelled'
            ])->default('brief');
            $table->integer('stage_progress')->default(0);     // 0-100%
            $table->json('measurements')->nullable();
            $table->json('fabric_requirements')->nullable();
            $table->json('colour_specs')->nullable();
            $table->decimal('quoted_price', 12, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->boolean('qc_passed')->nullable();
            $table->text('qc_notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('production_stage_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('production_orders')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->string('from_stage');
            $table->string('to_stage');
            $table->text('notes')->nullable();
            $table->timestamp('created_at');
        });

        // ─────────────────────────────────────────────────────────────────
        // PROJECT MANAGEMENT (Interiors Fit-Outs)
        // ─────────────────────────────────────────────────────────────────
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_number')->unique();         // MPS-PRJ-2026-001
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('manager_id')->constrained('users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', ['workplace', 'hospitality', 'retail', 'residential', 'other'])->default('other');
            $table->enum('status', ['planning', 'active', 'on_hold', 'completed', 'cancelled'])->default('planning');
            $table->decimal('budget', 14, 2)->nullable();
            $table->decimal('actual_cost', 14, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('completion_percent')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->date('completed_date')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'overdue'])->default('pending');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('project_contractors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('trade');                            // Electrician, Painter, Carpenter
            $table->string('phone')->nullable();
            $table->decimal('contract_value', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('project_site_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->date('visit_date');
            $table->text('observations')->nullable();
            $table->json('photos')->nullable();                 // File paths
            $table->enum('status', ['on_track', 'delayed', 'issue'])->default('on_track');
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // ECOMMERCE — Products, Orders, Customers
        // ─────────────────────────────────────────────────────────────────
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('parent_category')->nullable();
            $table->enum('vertical', ['bags', 'furniture', 'accessories']);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('compare_price', 12, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->boolean('is_custom_order')->default(false);
            $table->boolean('is_published')->default(false);
            $table->json('images')->nullable();
            $table->json('variants')->nullable();               // colours, sizes
            $table->json('tags')->nullable();
            $table->enum('vertical', ['bags', 'furniture', 'accessories']);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('retail_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('delivery_address')->nullable();
            $table->string('city')->default('Lusaka');
            $table->decimal('total_spent', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('ecommerce_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();           // MPS-SHOP-2026-0001
            $table->foreignId('customer_id')->nullable()->constrained('retail_customers');
            $table->enum('status', ['pending', 'confirmed', 'in_production', 'ready', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('pending');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('delivery_fee', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending');
            $table->enum('payment_method', ['cash', 'bank_transfer', 'mobile_money', 'card'])->nullable();
            $table->text('delivery_address')->nullable();
            $table->enum('delivery_method', ['pickup', 'delivery'])->default('pickup');
            $table->enum('channel', ['website', 'whatsapp', 'instagram', 'walk_in'])->default('website');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('ecommerce_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('total', 12, 2);
            $table->json('variant_options')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // HR & PAYROLL
        // ─────────────────────────────────────────────────────────────────
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');                             // Production, Design, Sales, Finance, Management
            $table->foreignId('head_of_department')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('department_id')->constrained('departments');
            $table->string('employee_number')->unique();        // MPS-EMP-001
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();
            $table->string('napsa_number')->nullable();         // Zambia NAPSA
            $table->string('nhima_number')->nullable();         // Zambia NHIMA
            $table->string('tpin')->nullable();                 // ZRA TPIN
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'intern'])->default('full_time');
            $table->string('job_title');
            $table->enum('vertical', ['bags', 'furniture', 'interiors', 'admin', 'shared'])->default('shared');
            $table->decimal('basic_salary', 12, 2);
            $table->enum('salary_type', ['monthly', 'daily', 'piece_rate'])->default('monthly');
            $table->date('hire_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'on_leave', 'suspended', 'terminated'])->default('active');
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('mobile_money_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->decimal('hours_worked', 5, 2)->default(0);
            $table->enum('status', ['present', 'absent', 'half_day', 'late', 'leave', 'holiday'])->default('present');
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->unique(['employee_id', 'date']);
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->enum('type', ['annual', 'sick', 'maternity', 'paternity', 'unpaid', 'emergency'])->default('annual');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_requested');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->string('period');                           // 2026-05
            $table->date('pay_date');
            $table->enum('status', ['draft', 'approved', 'processed'])->default('draft');
            $table->decimal('total_gross', 12, 2)->default(0);
            $table->decimal('total_paye', 12, 2)->default(0);  // ZRA PAYE
            $table->decimal('total_napsa', 12, 2)->default(0);
            $table->decimal('total_nhima', 12, 2)->default(0);
            $table->decimal('total_net', 12, 2)->default(0);
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_id')->constrained('payroll_runs')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('allowances', 12, 2)->default(0);
            $table->decimal('gross_pay', 12, 2);
            $table->decimal('paye_tax', 12, 2)->default(0);
            $table->decimal('napsa_employee', 12, 2)->default(0);
            $table->decimal('napsa_employer', 12, 2)->default(0);
            $table->decimal('nhima_employee', 12, 2)->default(0);
            $table->decimal('nhima_employer', 12, 2)->default(0);
            $table->decimal('other_deductions', 12, 2)->default(0);
            $table->decimal('net_pay', 12, 2);
            $table->integer('days_worked')->default(0);
            $table->integer('days_absent')->default(0);
            $table->json('deductions_breakdown')->nullable();
            $table->json('allowances_breakdown')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // ACCOUNTING — Ledger, Expenses, Suppliers
        // ─────────────────────────────────────────────────────────────────
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['asset', 'liability', 'equity', 'income', 'expense']);
            $table->string('sub_type')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();              // JNL-2026-0001
            $table->foreignId('user_id')->constrained('users');
            $table->date('entry_date');
            $table->text('description');
            $table->enum('source', ['invoice', 'payment', 'payroll', 'expense', 'manual']);
            $table->unsignedBigInteger('source_id')->nullable();
            $table->timestamps();
        });

        Schema::create('journal_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('chart_of_accounts');
            $table->decimal('debit', 12, 2)->default(0);
            $table->decimal('credit', 12, 2)->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('tpin')->nullable();
            $table->enum('category', ['fabric', 'hardware', 'timber', 'packaging', 'equipment', 'services', 'other']);
            $table->decimal('outstanding_balance', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recorded_by')->constrained('users');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('account_id')->nullable()->constrained('chart_of_accounts');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('currency')->default('ZMW');
            $table->date('expense_date');
            $table->enum('category', ['materials', 'utilities', 'rent', 'transport', 'marketing', 'salaries', 'equipment', 'maintenance', 'other']);
            $table->enum('vertical', ['bags', 'furniture', 'interiors', 'admin', 'shared'])->default('shared');
            $table->enum('payment_method', ['cash', 'bank_transfer', 'mobile_money', 'card'])->default('cash');
            $table->string('receipt_path')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // ─────────────────────────────────────────────────────────────────
        // MARKETING
        // ─────────────────────────────────────────────────────────────────
        Schema::create('marketing_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['email', 'social_media', 'event', 'corporate_outreach', 'whatsapp', 'print']);
            $table->enum('status', ['draft', 'scheduled', 'active', 'paused', 'completed'])->default('draft');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->decimal('actual_spend', 12, 2)->default(0);
            $table->json('target_audience')->nullable();
            $table->json('metrics')->nullable();                // impressions, clicks, conversions
            $table->timestamps();
        });

        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('marketing_campaigns');
            $table->foreignId('created_by')->constrained('users');
            $table->text('content');
            $table->json('media')->nullable();
            $table->json('platforms');                          // ['instagram', 'facebook', 'linkedin']
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'published', 'failed'])->default('draft');
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('marketing_campaigns');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('source');                           // website, instagram, referral, event
            $table->enum('interest', ['bags', 'furniture', 'interiors', 'corporate_bags', 'other']);
            $table->enum('status', ['new', 'contacted', 'qualified', 'converted', 'lost'])->default('new');
            $table->text('notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->timestamps();
        });

        // ─────────────────────────────────────────────────────────────────
        // SYSTEM SETTINGS
        // ─────────────────────────────────────────────────────────────────
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string');          // string, json, boolean, integer
            $table->string('group')->default('general');        // general, invoicing, hr, accounting
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type');
            $table->string('title');
            $table->text('message');
            $table->string('link')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Drop in reverse order to respect foreign key constraints
        $tables = [
            'notifications', 'settings', 'leads', 'social_posts', 'marketing_campaigns',
            'expenses', 'suppliers', 'journal_lines', 'journal_entries', 'chart_of_accounts',
            'payslips', 'payroll_runs', 'leave_requests', 'attendance', 'employees', 'departments',
            'ecommerce_order_items', 'ecommerce_orders', 'retail_customers', 'products', 'product_categories',
            'project_site_visits', 'project_contractors', 'project_milestones', 'projects',
            'production_stage_logs', 'production_orders',
            'inventory_transactions', 'inventory_items', 'inventory_categories',
            'payments', 'invoice_items', 'invoices',
            'client_interactions', 'clients',
            'audit_logs', 'users', 'roles',
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
