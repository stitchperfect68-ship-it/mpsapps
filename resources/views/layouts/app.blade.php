<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Operations Suite') — My Perfect Stitch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --navy:        #100736;
            --gold:        #F9B040;
            --gold-dark:   #d4922a;
            --cream:       #F7F5F2;
            --white:       #ffffff;
            --border:      #e8e4f0;
            --border-light:#f0eef8;
            --error:       #c0392b;
            --error-bg:    #fee2e2;
            --success:     #059669;
            --success-bg:  #d1fae5;
            --text:        #100736;
            --text-muted:  #6b6882;
            --text-light:  #9896a8;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Sidebar ───────────────────────────────────────── */
        .sidebar {
            width: 256px;
            background: var(--navy);
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 50;
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 767px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }

        /* Sidebar scrollbar */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(249,176,64,0.3); border-radius: 4px; }

        /* ── Sidebar overlay ───────────────────────────────── */
        #sidebarOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(16,7,54,0.5);
            z-index: 40;
            backdrop-filter: blur(2px);
        }
        #sidebarOverlay.visible { display: block; }

        /* ── Nav links ─────────────────────────────────────── */
        .nav-section {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(249,176,64,0.5);
            padding: 16px 20px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            font-weight: 400;
            text-decoration: none;
            transition: all 0.18s ease;
            border-left: 2px solid transparent;
        }
        .nav-link .nav-icon { font-size: 15px; width: 20px; text-align: center; flex-shrink: 0; }
        .nav-link:hover {
            color: #fff;
            background: rgba(249,176,64,0.08);
            border-left-color: rgba(249,176,64,0.5);
        }
        .nav-link.active {
            color: var(--gold);
            background: rgba(249,176,64,0.12);
            border-left-color: var(--gold);
            font-weight: 500;
        }

        /* ── Main content ──────────────────────────────────── */
        .main-content { min-height: 100vh; }
        @media (min-width: 768px) { .main-content { margin-left: 256px; } }

        /* ── Mobile topbar ─────────────────────────────────── */
        .mobile-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 30;
        }
        @media (min-width: 768px) { .mobile-topbar { display: none; } }

        /* ── Page structure ────────────────────────────────── */
        .page-header {
            padding: 16px 16px 14px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }
        @media (min-width: 640px)  { .page-header { padding: 20px 24px 18px; } }
        @media (min-width: 1024px) { .page-header { padding: 24px 32px 20px; } }

        .page-header-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--navy);
        }
        @media (min-width: 640px) { .page-title { font-size: 22px; } }

        .page-subtitle {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .page-body {
            padding: 16px;
        }
        @media (min-width: 640px)  { .page-body { padding: 20px 24px; } }
        @media (min-width: 1024px) { .page-body { padding: 24px 32px; } }

        /* ── Cards ─────────────────────────────────────────── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow-x: auto;
        }

        /* ── Buttons ───────────────────────────────────────── */
        .btn-gold {
            background: var(--gold);
            color: var(--navy);
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.18s;
        }
        .btn-gold:hover { background: var(--gold-dark); }

        .btn-navy {
            background: var(--navy);
            color: #fff;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.18s;
        }
        .btn-navy:hover { opacity: 0.88; }

        .btn-outline {
            border: 1.5px solid var(--border);
            color: var(--text-muted);
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.18s;
        }
        .btn-outline:hover { border-color: var(--navy); color: var(--navy); }

        /* ── Badges ────────────────────────────────────────── */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 2px 10px;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }
        .badge-gold    { background: rgba(249,176,64,0.15); color: #b37a1a; }
        .badge-navy    { background: rgba(16,7,54,0.08);   color: var(--navy); }
        .badge-success { background: var(--success-bg);    color: var(--success); }
        .badge-error   { background: var(--error-bg);      color: var(--error); }
        .badge-muted   { background: var(--border-light);  color: var(--text-muted); }

        /* ── Tables ────────────────────────────────────────── */
        table { width: 100%; border-collapse: collapse; min-width: 480px; }
        thead { background: var(--cream); }
        th {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 10px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        td {
            padding: 12px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border-light);
            color: var(--text);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(16,7,54,0.02); }

        /* ── Coming soon ───────────────────────────────────── */
        .coming-soon { text-align: center; padding: 60px 24px; }
        @media (min-width: 640px) { .coming-soon { padding: 80px 40px; } }
        .coming-soon .icon { font-size: 48px; margin-bottom: 16px; }
        .coming-soon h2 { font-size: 22px; font-weight: 600; color: var(--navy); margin-bottom: 8px; }
        .coming-soon p { font-size: 14px; color: var(--text-muted); }

        /* ── Forms ─────────────────────────────────────────── */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 6px;
            letter-spacing: 0.04em;
        }
        .form-input {
            width: 100%;
            background: var(--white);
            border: 1.5px solid var(--border);
            color: var(--text);
            padding: 10px 14px;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            outline: none;
            transition: border-color 0.18s;
        }
        .form-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(249,176,64,0.12); }
        .form-input::placeholder { color: var(--text-light); }
        select.form-input { cursor: pointer; }
        textarea.form-input { resize: vertical; min-height: 100px; }

        /* ── Alerts ────────────────────────────────────────── */
        .alert { padding: 12px 16px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; }
        .alert-error   { background: var(--error-bg); color: var(--error); border: 1px solid #fca5a5; }
        .alert-success { background: var(--success-bg); color: var(--success); border: 1px solid #6ee7b7; }
        .alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }

        /* ── Scrollbar ─────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--cream); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(16,7,54,0.2); }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══════════════════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════════════════ -->
<div class="sidebar" id="sidebar">

    <!-- Logo -->
    <div style="padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,0.08); flex-shrink:0;">
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
                <img src="{{ asset('images/logo.jpg') }}" alt="My Perfect Stitch" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);flex-shrink:0;">
                <div>
                    <div style="font-size:13px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:0.01em;">My Perfect Stitch</div>
                    <div style="font-size:9px;font-weight:500;color:rgba(249,176,64,0.7);letter-spacing:0.15em;text-transform:uppercase;margin-top:2px;">Ops Suite</div>
                </div>
            </a>
            <!-- Close btn (mobile only) -->
            <button onclick="closeSidebar()" style="margin-left:auto;background:none;border:none;color:rgba(255,255,255,0.4);cursor:pointer;padding:4px;line-height:1;flex-shrink:0;" class="md:hidden">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav style="padding: 8px 0; flex:1; overflow-y:auto;">
        <div class="nav-section">Core Ops</div>
        <a href="{{ route('invoicing.index') }}"  class="nav-link {{ request()->is('invoicing*')  ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🧾</span> Smart Invoicing</a>
        <a href="{{ route('production.index') }}"  class="nav-link {{ request()->is('production*') ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🏭</span> Production</a>
        <a href="{{ route('inventory.index') }}"   class="nav-link {{ request()->is('inventory*')  ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🧵</span> Inventory</a>
        <a href="{{ route('crm.index') }}"          class="nav-link {{ request()->is('crm*')         ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🤝</span> CRM</a>
        <a href="{{ route('projects.index') }}"    class="nav-link {{ request()->is('projects*')   ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">📐</span> Projects</a>
        <a href="{{ route('ecommerce.index') }}"   class="nav-link {{ request()->is('ecommerce*')  ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🛍️</span> Ecommerce</a>

        <div class="nav-section">Finance & People</div>
        <a href="{{ route('accounting.index') }}"  class="nav-link {{ request()->is('accounting*') ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">📊</span> Accounting</a>
        <a href="{{ route('hr.index') }}"           class="nav-link {{ request()->is('hr*')          ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">👔</span> HR & Payroll</a>

        <div class="nav-section">Growth</div>
        <a href="{{ route('marketing.index') }}"   class="nav-link {{ request()->is('marketing*')  ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">📣</span> Marketing</a>
        <a href="{{ route('analytics.index') }}"   class="nav-link {{ request()->is('analytics*')  ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">📈</span> Analytics</a>

        @if(auth()->user()->hasRole('super-admin'))
        <div class="nav-section">System</div>
        <a href="{{ route('admin.index') }}"        class="nav-link {{ request()->is('admin*')       ? 'active' : '' }}" onclick="closeSidebar()"><span class="nav-icon">🔐</span> Super Admin</a>
        @endif
    </nav>

    <!-- User info -->
    <div style="padding: 14px 20px; border-top: 1px solid rgba(255,255,255,0.08); flex-shrink:0;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
            <div style="width:34px;height:34px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:var(--navy);flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->first_name,0,1).substr(auth()->user()->last_name,0,1)) }}
            </div>
            <div style="min-width:0;">
                <div style="font-size:12px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                <div style="font-size:10px;color:rgba(249,176,64,0.7);margin-top:1px;">{{ auth()->user()->role?->display_name }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.5);padding:7px;border-radius:6px;font-size:11px;font-family:'Poppins',sans-serif;font-weight:500;cursor:pointer;transition:all 0.18s;letter-spacing:0.04em;" onmouseover="this.style.background='rgba(249,176,64,0.12)';this.style.color='var(--gold)';" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.5)';">
                Sign Out
            </button>
        </form>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════════════════════ -->
<div class="main-content">

    <!-- Mobile topbar -->
    <div class="mobile-topbar">
        <button onclick="openSidebar()" style="background:none;border:none;color:rgba(255,255,255,0.7);cursor:pointer;padding:4px;">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
            <img src="{{ asset('images/logo.jpg') }}" alt="MPS" style="width:30px;height:30px;border-radius:50%;object-fit:cover;border:1.5px solid var(--gold);">
            <span style="font-size:13px;font-weight:700;color:#fff;">My Perfect Stitch</span>
        </a>
        <div style="width:32px;height:32px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--navy);">
            {{ strtoupper(substr(auth()->user()->first_name,0,1).substr(auth()->user()->last_name,0,1)) }}
        </div>
    </div>

    @yield('content')
</div>

<script>
function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('visible');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('visible');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });
</script>

@stack('scripts')
</body>
</html>
