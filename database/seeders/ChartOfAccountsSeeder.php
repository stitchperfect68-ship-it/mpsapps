<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // Assets
            ['code' => '1000', 'name' => 'Cash', 'type' => 'asset', 'sub_type' => 'current'],
            ['code' => '1010', 'name' => 'Bank Account — FNB', 'type' => 'asset', 'sub_type' => 'current'],
            ['code' => '1020', 'name' => 'Mobile Money — Airtel', 'type' => 'asset', 'sub_type' => 'current'],
            ['code' => '1100', 'name' => 'Accounts Receivable', 'type' => 'asset', 'sub_type' => 'current'],
            ['code' => '1200', 'name' => 'Inventory — Raw Materials', 'type' => 'asset', 'sub_type' => 'current'],
            ['code' => '1500', 'name' => 'Equipment & Machinery', 'type' => 'asset', 'sub_type' => 'fixed'],
            ['code' => '1510', 'name' => 'Furniture & Fittings', 'type' => 'asset', 'sub_type' => 'fixed'],

            // Liabilities
            ['code' => '2000', 'name' => 'Accounts Payable', 'type' => 'liability', 'sub_type' => 'current'],
            ['code' => '2100', 'name' => 'VAT Payable (ZRA 16%)', 'type' => 'liability', 'sub_type' => 'current'],
            ['code' => '2110', 'name' => 'PAYE Payable', 'type' => 'liability', 'sub_type' => 'current'],
            ['code' => '2120', 'name' => 'NAPSA Payable', 'type' => 'liability', 'sub_type' => 'current'],
            ['code' => '2130', 'name' => 'NHIMA Payable', 'type' => 'liability', 'sub_type' => 'current'],

            // Equity
            ['code' => '3000', 'name' => 'Owner\'s Capital', 'type' => 'equity', 'sub_type' => null],
            ['code' => '3100', 'name' => 'Retained Earnings', 'type' => 'equity', 'sub_type' => null],

            // Income
            ['code' => '4000', 'name' => 'Sales — Bags', 'type' => 'income', 'sub_type' => 'revenue'],
            ['code' => '4010', 'name' => 'Sales — Furniture', 'type' => 'income', 'sub_type' => 'revenue'],
            ['code' => '4020', 'name' => 'Sales — Interiors', 'type' => 'income', 'sub_type' => 'revenue'],
            ['code' => '4030', 'name' => 'Sales — Ecommerce', 'type' => 'income', 'sub_type' => 'revenue'],

            // Expenses
            ['code' => '5000', 'name' => 'Cost of Goods — Fabrics', 'type' => 'expense', 'sub_type' => 'cogs'],
            ['code' => '5010', 'name' => 'Cost of Goods — Materials', 'type' => 'expense', 'sub_type' => 'cogs'],
            ['code' => '5100', 'name' => 'Salaries & Wages', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5110', 'name' => 'Rent', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5120', 'name' => 'Utilities', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5130', 'name' => 'Transport & Delivery', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5140', 'name' => 'Marketing & Advertising', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5150', 'name' => 'Equipment Maintenance', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5160', 'name' => 'Office Expenses', 'type' => 'expense', 'sub_type' => 'operating'],
            ['code' => '5200', 'name' => 'Bank Charges', 'type' => 'expense', 'sub_type' => 'other'],
        ];

        foreach ($accounts as $account) {
            ChartOfAccount::updateOrCreate(['code' => $account['code']], $account + ['is_active' => true]);
        }
    }
}
