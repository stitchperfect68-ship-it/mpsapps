<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — My Perfect Stitch Operations Suite</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --navy:         #100736;
            --navy-light:   #1a0f4a;
            --gold:         #F9B040;
            --gold-dark:    #d4922a;
            --gold-pale:    rgba(249,176,64,0.12);
            --cream:        #F7F5F2;
            --white:        #ffffff;
            --border:       #e8e4f0;
            --border-light: #f0eef8;
            --text:         #100736;
            --text-muted:   #6b6882;
            --text-light:   #9896a8;
            --error:        #c0392b;
            --error-bg:     #fee2e2;
            --success:      #059669;
            --success-bg:   #d1fae5;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Top Nav ───────────────────────────────────────── */
        .top-nav {
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 3px solid var(--gold);
        }

        .nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        @media (min-width: 640px) { .nav-inner { padding: 0 24px; } }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .nav-logo img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold);
        }
        .nav-logo-text { display: none; }
        @media (min-width: 480px) { .nav-logo-text { display: block; } }
        .nav-logo-name {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        .nav-logo-sub {
            font-size: 9px;
            font-weight: 500;
            color: rgba(249,176,64,0.7);
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        /* Search */
        .nav-search {
            flex: 1;
            max-width: 360px;
            position: relative;
            display: none;
        }
        @media (min-width: 768px) { .nav-search { display: block; } }
        .nav-search input {
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1.5px solid rgba(255,255,255,0.12);
            color: #fff;
            padding: 9px 14px 9px 38px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
        }
        .nav-search input:focus {
            background: rgba(255,255,255,0.12);
            border-color: var(--gold);
        }
        .nav-search input::placeholder { color: rgba(255,255,255,0.35); }
        .nav-search svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: rgba(255,255,255,0.35);
        }

        /* Nav right */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .nav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
            flex-shrink: 0;
        }
        .nav-user-info { display: none; }
        @media (min-width: 640px) { .nav-user-info { display: block; } }
        .nav-user-name  { font-size: 13px; font-weight: 600; color: #fff; }
        .nav-user-role  { font-size: 10px; color: rgba(249,176,64,0.8); }

        /* ── Hero ──────────────────────────────────────────── */
        .hero {
            background: var(--navy);
            padding: 32px 16px 28px;
            border-bottom: 1px solid rgba(249,176,64,0.2);
        }
        @media (min-width: 640px) { .hero { padding: 40px 24px 32px; } }

        .hero-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
            justify-content: space-between;
        }

        .hero-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(5,150,105,0.15);
            border: 1px solid rgba(5,150,105,0.3);
            color: #34d399;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .status-dot {
            width: 6px; height: 6px;
            background: #34d399;
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(52,211,153,0.6);
            animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

        .hero-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        @media (min-width: 640px) { .hero-title { font-size: 36px; } }
        @media (min-width: 1024px) { .hero-title { font-size: 42px; } }

        .hero-title span {
            color: var(--gold);
        }

        .hero-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            margin-top: 6px;
            max-width: 480px;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .btn-hero-primary {
            background: var(--gold);
            color: var(--navy);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.18s;
            white-space: nowrap;
        }
        .btn-hero-primary:hover { background: var(--gold-dark); }

        .btn-hero-outline {
            border: 1.5px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.8);
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .btn-hero-outline:hover { border-color: var(--gold); color: var(--gold); }

        /* ── Mobile search bar ─────────────────────────────── */
        .mobile-search {
            background: var(--navy);
            padding: 0 16px 16px;
            display: block;
        }
        @media (min-width: 768px) { .mobile-search { display: none; } }
        .mobile-search input {
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1.5px solid rgba(255,255,255,0.12);
            color: #fff;
            padding: 10px 14px 10px 40px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            outline: none;
        }
        .mobile-search input::placeholder { color: rgba(255,255,255,0.35); }
        .mobile-search-wrap { position: relative; }
        .mobile-search-wrap svg {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px; color: rgba(255,255,255,0.35);
        }

        /* ── Stats strip ───────────────────────────────────── */
        .stats-strip {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px;
        }
        @media (min-width: 640px) { .stats-strip { padding: 0 24px; } }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 20px 0;
        }
        @media (min-width: 640px)  { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 768px)  { .stats-grid { grid-template-columns: repeat(4, 1fr); } }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gold);
            border-radius: 10px 10px 0 0;
        }
        .stat-card.accent-success::before { background: var(--success); }
        .stat-card.accent-error::before   { background: var(--error); }
        .stat-card.accent-navy::before    { background: var(--navy); }

        .stat-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--navy);
            line-height: 1;
        }
        @media (min-width: 640px) { .stat-value { font-size: 32px; } }
        .stat-sub {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 4px;
        }

        /* ── Modules grid ──────────────────────────────────── */
        .modules-wrap {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px 32px;
        }
        @media (min-width: 640px) { .modules-wrap { padding: 0 24px 40px; } }

        .section-heading {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 24px 0 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-heading::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 12px;
        }
        @media (min-width: 480px)  { .modules-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .modules-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1280px) { .modules-grid { grid-template-columns: repeat(4, 1fr); } }

        /* Module card */
        .mod-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            text-decoration: none;
            display: block;
            position: relative;
            transition: all 0.22s cubic-bezier(0.23,1,0.32,1);
            overflow: hidden;
        }
        .mod-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.25s ease;
        }
        .mod-card:hover {
            border-color: var(--gold);
            box-shadow: 0 8px 32px rgba(16,7,54,0.1);
            transform: translateY(-3px);
        }
        .mod-card:hover::after { transform: scaleX(1); }

        .mod-num {
            position: absolute;
            top: 14px; right: 16px;
            font-size: 11px;
            font-weight: 600;
            color: var(--border);
            letter-spacing: 0.06em;
        }

        .mod-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .mod-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .mod-desc {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 12px;
        }

        .mod-badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }

        /* ── Bottom info row ───────────────────────────────── */
        .info-row {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px 40px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }
        @media (min-width: 640px) { .info-row { padding: 0 24px 40px; } }
        @media (min-width: 768px) { .info-row { grid-template-columns: 2fr 1fr; } }

        .info-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 20px 24px;
        }

        .info-card-title {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        /* ── Footer ────────────────────────────────────────── */
        .site-footer {
            background: var(--navy);
            border-top: 3px solid var(--gold);
            padding: 20px 16px;
        }
        @media (min-width: 640px) { .site-footer { padding: 20px 24px; } }

        .footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-logo img {
            width: 28px; height: 28px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid var(--gold);
        }
        .footer-copy {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
        }
        .footer-tech {
            font-size: 11px;
            color: rgba(255,255,255,0.2);
        }

        /* ── Stagger animation ─────────────────────────────── */
        .mod-card {
            opacity: 0;
            animation: fadeUp 0.4s ease forwards;
        }
        @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
        .mod-card:nth-child(1)  { animation-delay:0.04s }
        .mod-card:nth-child(2)  { animation-delay:0.08s }
        .mod-card:nth-child(3)  { animation-delay:0.12s }
        .mod-card:nth-child(4)  { animation-delay:0.16s }
        .mod-card:nth-child(5)  { animation-delay:0.20s }
        .mod-card:nth-child(6)  { animation-delay:0.24s }
        .mod-card:nth-child(7)  { animation-delay:0.28s }
        .mod-card:nth-child(8)  { animation-delay:0.32s }
        .mod-card:nth-child(9)  { animation-delay:0.36s }
        .mod-card:nth-child(10) { animation-delay:0.40s }
        .mod-card:nth-child(11) { animation-delay:0.44s }
        .mod-card:nth-child(12) { animation-delay:0.48s }

        /* ── No results ────────────────────────────────────── */
        #noResults { display:none; }
        #noResults.visible { display:block; }
    </style>
</head>
<body>

<!-- ══════════════════════════════════════════════════════
     TOP NAV
═══════════════════════════════════════════════════════ -->
<nav class="top-nav">
    <div class="nav-inner">
        <a href="{{ route('dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="My Perfect Stitch">
            <div class="nav-logo-text">
                <div class="nav-logo-name">My Perfect Stitch</div>
                <div class="nav-logo-sub">Operations Suite</div>
            </div>
        </a>

        <div class="nav-search">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="Search modules…" id="moduleSearch" onkeyup="filterModules(this.value)">
        </div>

        <div class="nav-right">
            <div class="nav-user">
                <div class="nav-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name,0,1).substr(auth()->user()->last_name,0,1)) }}
                </div>
                <div class="nav-user-info">
                    <div class="nav-user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="nav-user-role">{{ auth()->user()->role?->display_name }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.6);padding:6px 14px;border-radius:6px;font-family:'Poppins',sans-serif;font-size:12px;font-weight:500;cursor:pointer;transition:all 0.18s;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='rgba(255,255,255,0.6)';">
                    Sign out
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- ══════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-inner">
        <div>
            <div class="hero-status">
                <span class="status-dot"></span>
                All Systems Operational
            </div>
            <h1 class="hero-title">
                Good morning, <span>{{ auth()->user()->first_name }}.</span>
            </h1>
            <p class="hero-sub">
                12 modules. One shared database. Everything you need to run My Perfect Stitch — from production to payroll.
            </p>
        </div>
        <div class="hero-actions">
            <a href="{{ route('admin.index') }}" class="btn-hero-outline">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Settings
            </a>
            <a href="https://myperfectstitch.com" target="_blank" class="btn-hero-primary">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
        </div>
    </div>
</section>

<!-- Mobile search -->
<div class="mobile-search">
    <div class="mobile-search-wrap">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" placeholder="Search modules…" onkeyup="filterModules(this.value)">
    </div>
</div>

<!-- ══════════════════════════════════════════════════════
     STATS
═══════════════════════════════════════════════════════ -->
<div class="stats-strip">
    <div class="stats-grid">
        <div class="stat-card accent-navy">
            <div class="stat-label">Active Orders</div>
            <div class="stat-value">{{ $stats['active_orders'] }}</div>
            <div class="stat-sub">In production</div>
        </div>
        <div class="stat-card accent-success">
            <div class="stat-label">Revenue (ZMW)</div>
            <div class="stat-value" style="font-size:22px;font-weight:700;">{{ number_format($stats['monthly_revenue'], 0) }}</div>
            <div class="stat-sub">This month</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Staff on Duty</div>
            <div class="stat-value">{{ $stats['staff_on_duty'] }}<span style="font-size:14px;font-weight:500;color:var(--text-light);"> / {{ $stats['total_staff'] }}</span></div>
            <div class="stat-sub">Today</div>
        </div>
        <div class="stat-card accent-error">
            <div class="stat-label">Pending Invoices</div>
            <div class="stat-value" style="color:var(--error);">{{ $stats['pending_invoices'] }}</div>
            <div class="stat-sub">{{ $stats['overdue_invoices'] }} overdue</div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════
     MODULE GRID
═══════════════════════════════════════════════════════ -->
<div class="modules-wrap">

    <!-- Core Operations -->
    <div class="section-heading">Core Operations</div>
    <div class="modules-grid" id="appsGrid">

        <a href="{{ route('invoicing.index') }}" class="mod-card" data-name="smart invoicing quotes payments receipts">
            <span class="mod-num">01</span>
            <div class="mod-icon" style="background:#fff3e0;">🧾</div>
            <div class="mod-name">Smart Invoicing</div>
            <div class="mod-desc">Quotes, proforma invoices, VAT receipts & client payment tracking.</div>
            <div class="mod-badge" style="background:#fff3e0;color:#e65100;">{{ $stats['pending_invoices'] }} Pending</div>
        </a>

        <a href="{{ route('production.index') }}" class="mod-card" data-name="order production manufacturing bags furniture interiors">
            <span class="mod-num">02</span>
            <div class="mod-icon" style="background:#e8f5e9;">🏭</div>
            <div class="mod-name">Order & Production</div>
            <div class="mod-desc">Track every order from Brief → Design → Production → QC → Delivery.</div>
            <div class="mod-badge" style="background:#e8f5e9;color:#2e7d32;">{{ $stats['active_orders'] }} Active</div>
        </a>

        <a href="{{ route('inventory.index') }}" class="mod-card" data-name="inventory stock fabric materials chitenge leather foam">
            <span class="mod-num">03</span>
            <div class="mod-icon" style="background:rgba(249,176,64,0.12);">🧵</div>
            <div class="mod-name">Inventory</div>
            <div class="mod-desc">Manage fabric, chitenge, leather, foam & materials across all verticals.</div>
            <div class="mod-badge" style="background:rgba(249,176,64,0.15);color:#b37a1a;">{{ $stats['low_stock_items'] }} Low Stock</div>
        </a>

        <a href="{{ route('crm.index') }}" class="mod-card" data-name="crm clients customers corporate institutional relationships">
            <span class="mod-num">04</span>
            <div class="mod-icon" style="background:#ede7f6;">🤝</div>
            <div class="mod-name">CRM</div>
            <div class="mod-desc">Manage ZESCO, ABSA, Airtel and all institutional client accounts & pipelines.</div>
            <div class="mod-badge" style="background:#ede7f6;color:#4527a0;">Clients</div>
        </a>

        <a href="{{ route('projects.index') }}" class="mod-card" data-name="projects interior fitout milestones timeline contractors">
            <span class="mod-num">05</span>
            <div class="mod-icon" style="background:#e3f2fd;">📐</div>
            <div class="mod-name">Project Management</div>
            <div class="mod-desc">Interior fit-out projects, milestones, contractors, site visits & timeline tracking.</div>
            <div class="mod-badge" style="background:#e3f2fd;color:#1565c0;">Projects</div>
        </a>

        <a href="{{ route('ecommerce.index') }}" class="mod-card" data-name="ecommerce shop online store products bags furniture">
            <span class="mod-num">06</span>
            <div class="mod-icon" style="background:#e8f5e9;">🛍️</div>
            <div class="mod-name">Ecommerce</div>
            <div class="mod-desc">Online store — products, orders, delivery and retail customer experience.</div>
            <div class="mod-badge" style="background:#e8f5e9;color:#2e7d32;">{{ $stats['new_shop_orders'] }} New Orders</div>
        </a>

    </div>

    <!-- Finance & People -->
    <div class="section-heading">Finance & People</div>
    <div class="modules-grid">

        <a href="{{ route('accounting.index') }}" class="mod-card" data-name="accounting finance books expenses revenue ledger zra">
            <span class="mod-num">07</span>
            <div class="mod-icon" style="background:rgba(249,176,64,0.12);">📊</div>
            <div class="mod-name">Accounting</div>
            <div class="mod-desc">Income, expenses, supplier payments, ZRA reports — auto-synced from invoicing.</div>
            <div class="mod-badge" style="background:rgba(249,176,64,0.15);color:#b37a1a;">{{ date('M Y') }}</div>
        </a>

        <a href="{{ route('hr.index') }}" class="mod-card" data-name="hr human resource payroll staff attendance leave salary napsa nhima">
            <span class="mod-num">08</span>
            <div class="mod-icon" style="background:#f3e5f5;">👔</div>
            <div class="mod-name">HR & Payroll</div>
            <div class="mod-desc">Staff records, attendance, leave management & monthly payroll with PAYE/NAPSA/NHIMA.</div>
            <div class="mod-badge" style="background:#f3e5f5;color:#6a1b9a;">{{ $stats['total_staff'] }} Employees</div>
        </a>

    </div>

    <!-- Growth -->
    <div class="section-heading">Growth & Visibility</div>
    <div class="modules-grid">

        <a href="{{ route('marketing.index') }}" class="mod-card" data-name="marketing campaigns social media promotions events outreach">
            <span class="mod-num">09</span>
            <div class="mod-icon" style="background:#fce4ec;">📣</div>
            <div class="mod-name">Marketing</div>
            <div class="mod-desc">Campaigns, social media scheduler, event promotion & corporate outreach tools.</div>
            <div class="mod-badge" style="background:#fce4ec;color:#880e4f;">Campaigns</div>
        </a>

        <a href="{{ route('analytics.index') }}" class="mod-card" data-name="analytics reports business intelligence dashboard metrics">
            <span class="mod-num">10</span>
            <div class="mod-icon" style="background:#e0f2f1;">📈</div>
            <div class="mod-name">Analytics</div>
            <div class="mod-desc">Business intelligence — revenue, production output, top clients & performance trends.</div>
            <div class="mod-badge" style="background:#e0f2f1;color:#004d40;">Live Data</div>
        </a>

    </div>

    <!-- System -->
    <div class="section-heading">System & Communications</div>
    <div class="modules-grid">

        <a href="{{ route('admin.index') }}" class="mod-card" data-name="admin super administrator roles permissions users system settings">
            <span class="mod-num">11</span>
            <div class="mod-icon" style="background:#ffebee;">🔐</div>
            <div class="mod-name">Super Admin</div>
            <div class="mod-desc">User roles, permissions, module access control, audit logs & system configuration.</div>
            <div class="mod-badge" style="background:#ffebee;color:#b71c1c;">Admin</div>
        </a>

        <a href="https://slack.com" target="_blank" class="mod-card" data-name="slack communication chat messaging team">
            <span class="mod-num">12</span>
            <div class="mod-icon" style="background:#e8eaf6;">💬</div>
            <div class="mod-name">Slack</div>
            <div class="mod-desc">Internal team communication — channels for production, design, sales & management.</div>
            <div class="mod-badge" style="background:#e8eaf6;color:#283593;">External ↗</div>
        </a>

        <!-- No results -->
        <div id="noResults" style="grid-column:1/-1;text-align:center;padding:48px 24px;color:var(--text-muted);">
            <div style="font-size:36px;margin-bottom:12px;">🔍</div>
            <div style="font-size:17px;font-weight:600;color:var(--navy);margin-bottom:6px;">No modules found</div>
            <div style="font-size:13px;">Try a different search term</div>
        </div>

    </div>

    <!-- Info row -->
    <div class="info-row" style="padding-left:0;padding-right:0;">
        <div class="info-card">
            <div class="info-card-title">Shared Database Architecture</div>
            <div style="font-size:15px;font-weight:600;color:var(--navy);margin-bottom:8px;">One database. All 12 modules. Zero silos.</div>
            <p style="font-size:12px;color:var(--text-muted);line-height:1.7;margin-bottom:14px;">
                Every module reads and writes to a single MySQL database. Invoices auto-post to Accounting. Orders sync to Inventory. Payroll flows into Accounting. Client data from CRM is instantly available in Invoicing, Ecommerce and Marketing.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                @foreach(['MySQL 8', 'Laravel 12', 'Poppins UI', 'File Cache', 'Role-Based Access', 'ZRA VAT 16%'] as $tech)
                <span style="font-size:10px;font-weight:500;background:var(--border-light);border:1px solid var(--border);color:var(--text-muted);padding:3px 10px;border-radius:20px;">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
        <div class="info-card">
            <div class="info-card-title">System Status</div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach(['Database','Web Server','File Storage','Email','Queue'] as $svc)
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:13px;color:var(--text-muted);">{{ $svc }}</span>
                    <span style="display:flex;align-items:center;gap:5px;font-size:11px;font-weight:500;color:var(--success);">
                        <span style="width:6px;height:6px;border-radius:50%;background:var(--success);box-shadow:0 0 5px rgba(5,150,105,0.5);display:inline-block;"></span>
                        Online
                    </span>
                </div>
                @endforeach
            </div>
            <div style="margin-top:14px;padding-top:12px;border-top:1px solid var(--border);font-size:11px;color:var(--text-light);">
                Last backup: <span style="color:var(--navy);font-weight:500;">Today, 03:00 AM</span>
            </div>
        </div>
    </div>

</div>

<!-- ══════════════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════════════ -->
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="MPS">
            <span class="footer-copy">My Perfect Stitch Operations Suite &copy; {{ date('Y') }}</span>
        </div>
        <div class="footer-tech">
            Lusaka, Zambia &nbsp;·&nbsp; Laravel {{ app()->version() }} &nbsp;·&nbsp; PHP {{ PHP_VERSION }}
        </div>
    </div>
</footer>

<script>
function filterModules(query) {
    const q = query.toLowerCase().trim();
    const allCards = document.querySelectorAll('.mod-card[data-name]');
    const allSections = document.querySelectorAll('.section-heading');
    let visibleCount = 0;

    allCards.forEach(card => {
        const match = !q || card.getAttribute('data-name').includes(q);
        card.style.display = match ? '' : 'none';
        if (match) visibleCount++;
    });

    document.getElementById('noResults').classList.toggle('visible', visibleCount === 0);

    allSections.forEach(label => {
        const grid = label.nextElementSibling;
        if (grid) {
            const anyVisible = [...grid.querySelectorAll('.mod-card[data-name]')].some(c => c.style.display !== 'none');
            label.style.display = anyVisible ? '' : 'none';
        }
    });
}
</script>
</body>
</html>
