# 🪡 My Perfect Stitch — Operations Suite

**A unified, full-stack business management platform built for My Perfect Stitch, Lusaka, Zambia.**

Stack: **PHP Laravel 11 · MySQL 8 · Tailwind CSS 3 · Redis**

---

## 📦 Modules (12 Total)

| # | Module | Purpose | DB Tables |
|---|--------|---------|-----------|
| 01 | 🧾 **Smart Invoicing** | Quotes, proforma invoices, VAT receipts, payments | `invoices`, `invoice_items`, `payments` |
| 02 | 🏭 **Order & Production** | 4-stage order tracking: Brief → Design → Production → Delivery | `production_orders`, `production_stage_logs` |
| 03 | 🧵 **Inventory** | Fabric, materials, stock levels, reorder alerts | `inventory_items`, `inventory_transactions`, `inventory_categories` |
| 04 | 🤝 **CRM** | Institutional clients, interactions, pipeline management | `clients`, `client_interactions` |
| 05 | 📐 **Project Management** | Interior fit-out milestones, contractors, site visits | `projects`, `project_milestones`, `project_contractors`, `project_site_visits` |
| 06 | 🛍️ **Ecommerce** | Online store — bags & furniture products, orders, customers | `products`, `ecommerce_orders`, `ecommerce_order_items`, `retail_customers` |
| 07 | 📊 **Accounting** | Ledger, expenses, supplier payments, ZRA reports | `journal_entries`, `journal_lines`, `expenses`, `suppliers`, `chart_of_accounts` |
| 08 | 👔 **HR & Payroll** | Staff, attendance register, leave, PAYE/NAPSA/NHIMA payroll | `employees`, `attendance`, `leave_requests`, `payroll_runs`, `payslips` |
| 09 | 📣 **Marketing** | Campaigns, social scheduler, events, leads | `marketing_campaigns`, `social_posts`, `leads` |
| 10 | 📈 **Analytics** | Business intelligence across all verticals | Reads from all tables |
| 11 | 🔐 **Super Admin** | Users, roles, permissions, audit logs, system settings | `users`, `roles`, `audit_logs`, `settings` |
| 12 | 💬 **Slack** | External link to team Slack workspace | — |

---

## 🗄️ Shared Database Architecture

All 12 modules share **one MySQL database** (`mps_operations`). Data flows automatically:

```
CRM ──────────────► Production Orders ──► Inventory (deduct materials)
                           │
                           ▼
                       Invoicing ──────────► Accounting (auto journal)
                                                   ▲
                    HR & Payroll ──────────────────┘

Ecommerce Orders ──► Inventory ──► Invoicing ──► Accounting
Marketing Leads  ──► CRM
```

---

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Redis
- Composer
- Node.js 18+

### Setup

```bash
# 1. Clone / place files
cd /var/www/mps-suite

# 2. Install PHP dependencies
composer install --optimize-autoloader --no-dev

# 3. Install JS dependencies
npm install && npm run build

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Configure .env
# Set DB_DATABASE, DB_USERNAME, DB_PASSWORD
# Set MAIL_* credentials
# Set MPS_TPIN and other business settings

# 6. Run migrations
php artisan migrate

# 7. Seed initial data (roles, chart of accounts, default settings)
php artisan db:seed

# 8. Create storage symlink
php artisan storage:link

# 9. Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 10. Optimise for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 11. Queue worker (for emails, PDF generation, notifications)
php artisan queue:work --daemon
```

### First Login

After seeding, log in with:
- **Email:** `admin@myperfectstitch.co.zm`
- **Password:** `ChangeMe@2026!` ← change immediately

---

## 🗂️ File Structure

```
mps-suite/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── InvoicingController.php
│   │   ├── ProductionController.php
│   │   ├── InventoryController.php
│   │   ├── CrmController.php
│   │   ├── ProjectController.php
│   │   ├── EcommerceController.php
│   │   ├── AccountingController.php
│   │   ├── HrController.php
│   │   ├── MarketingController.php
│   │   ├── AnalyticsController.php
│   │   └── AdminController.php
│   └── Models/
│       ├── User.php
│       ├── Client.php
│       ├── Invoice.php
│       ├── ProductionOrder.php
│       ├── InventoryItem.php
│       ├── Project.php
│       ├── Product.php
│       ├── Employee.php
│       └── ...
├── database/
│   └── migrations/
│       └── 2026_01_01_000000_create_mps_schema.php
├── resources/
│   └── views/
│       ├── dashboard.blade.php         ← App Suite Home
│       ├── invoicing/
│       ├── production/
│       ├── inventory/
│       ├── crm/
│       ├── projects/
│       ├── ecommerce/
│       ├── accounting/
│       ├── hr/
│       ├── marketing/
│       ├── analytics/
│       └── admin/
├── routes/
│   └── web.php
├── .env.example
└── README.md
```

---

## 🔐 User Roles

| Role | Access |
|------|--------|
| `super-admin` | All 12 modules + system settings |
| `manager` | All except Super Admin |
| `production` | Production, Inventory |
| `sales` | CRM, Invoicing, Ecommerce, Marketing |
| `accounts` | Invoicing, Accounting, Analytics |
| `hr-manager` | HR & Payroll |

---

## 🇿🇲 Zambia-Specific Configurations

- **Currency:** Zambian Kwacha (ZMW)
- **Timezone:** Africa/Lusaka (CAT, UTC+2)
- **VAT:** 16% (ZRA standard rate)
- **NAPSA:** 5% employee + 5% employer (National Pension Scheme Authority)
- **NHIMA:** 1% employee + 1% employer (National Health Insurance)
- **PAYE:** Progressive ZRA tax bands applied automatically

---

## 📋 Development Roadmap

- [ ] Module 01: Smart Invoicing — PDF generation, email delivery
- [ ] Module 02: Production Board — Kanban drag-and-drop
- [ ] Module 03: Inventory — Barcode scanning support
- [ ] Module 04: CRM — Pipeline Kanban
- [ ] Module 05: Projects — Gantt chart view
- [ ] Module 06: Ecommerce — M-Pesa / Airtel Money integration
- [ ] Module 07: Accounting — ZRA e-Invoice integration
- [ ] Module 08: HR — Biometric attendance integration
- [ ] Module 09: Marketing — Social media API connections
- [ ] Module 10: Analytics — Export to Excel/PDF
- [ ] Module 11: Super Admin — 2FA authentication
- [ ] Mobile PWA version

---

*Built for My Perfect Stitch · Lusaka, Zambia · Creating Happiness*
