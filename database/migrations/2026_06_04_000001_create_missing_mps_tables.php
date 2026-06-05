<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This migration is intentionally idempotent.
 * On a fresh database the first migration already creates these tables,
 * so every Schema::create here is guarded with a hasTable() check.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('head_of_department')->nullable()->constrained('users');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users');
                $table->foreignId('department_id')->constrained('departments');
                $table->string('employee_number')->unique();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('national_id')->nullable();
                $table->string('napsa_number')->nullable();
                $table->string('nhima_number')->nullable();
                $table->string('tpin')->nullable();
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
        }

        if (!Schema::hasTable('attendance')) {
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
        }

        if (!Schema::hasTable('leave_requests')) {
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
        }

        if (!Schema::hasTable('payroll_runs')) {
            Schema::create('payroll_runs', function (Blueprint $table) {
                $table->id();
                $table->string('period');
                $table->date('pay_date');
                $table->enum('status', ['draft', 'approved', 'processed'])->default('draft');
                $table->decimal('total_gross', 12, 2)->default(0);
                $table->decimal('total_paye', 12, 2)->default(0);
                $table->decimal('total_napsa', 12, 2)->default(0);
                $table->decimal('total_nhima', 12, 2)->default(0);
                $table->decimal('total_net', 12, 2)->default(0);
                $table->foreignId('processed_by')->nullable()->constrained('users');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('payslips')) {
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
        }

        if (!Schema::hasTable('chart_of_accounts')) {
            Schema::create('chart_of_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->enum('type', ['asset', 'liability', 'equity', 'income', 'expense']);
                $table->string('sub_type')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('journal_entries')) {
            Schema::create('journal_entries', function (Blueprint $table) {
                $table->id();
                $table->string('reference')->unique();
                $table->foreignId('user_id')->constrained('users');
                $table->date('entry_date');
                $table->text('description');
                $table->enum('source', ['invoice', 'payment', 'payroll', 'expense', 'manual']);
                $table->unsignedBigInteger('source_id')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('journal_lines')) {
            Schema::create('journal_lines', function (Blueprint $table) {
                $table->id();
                $table->foreignId('journal_entry_id')->constrained('journal_entries')->cascadeOnDelete();
                $table->foreignId('account_id')->constrained('chart_of_accounts');
                $table->decimal('debit', 12, 2)->default(0);
                $table->decimal('credit', 12, 2)->default(0);
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('suppliers')) {
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
        }

        if (!Schema::hasTable('expenses')) {
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
        }

        if (!Schema::hasTable('marketing_campaigns')) {
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
                $table->json('metrics')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('social_posts')) {
            Schema::create('social_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('campaign_id')->nullable()->constrained('marketing_campaigns');
                $table->foreignId('created_by')->constrained('users');
                $table->text('content');
                $table->json('media')->nullable();
                $table->json('platforms');
                $table->timestamp('scheduled_at')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->enum('status', ['draft', 'scheduled', 'published', 'failed'])->default('draft');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('campaign_id')->nullable()->constrained('marketing_campaigns');
                $table->string('name');
                $table->string('company')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('source');
                $table->enum('interest', ['bags', 'furniture', 'interiors', 'corporate_bags', 'other']);
                $table->enum('status', ['new', 'contacted', 'qualified', 'converted', 'lost'])->default('new');
                $table->text('notes')->nullable();
                $table->foreignId('assigned_to')->nullable()->constrained('users');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->string('type')->default('string');
                $table->string('group')->default('general');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('notifications')) {
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
    }

    public function down(): void
    {
        $tables = [
            'notifications', 'settings', 'leads', 'social_posts', 'marketing_campaigns',
            'expenses', 'suppliers', 'journal_lines', 'journal_entries', 'chart_of_accounts',
            'payslips', 'payroll_runs', 'leave_requests', 'attendance', 'employees', 'departments',
        ];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
