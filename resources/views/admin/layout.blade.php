<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EGTS Admin Panel - @yield('title')</title>

{{-- Favicon --}}
<link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
<link rel="shortcut icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
<link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

<style>
  :root{
    --navy:#0F1526;
    --navy-hover:#1A2138;
    --sidebar:#ffffff;
    --sidebar-line:#EDEEF3;
    --sidebar-text:#5B6272;
    --sidebar-text-active:#171B2C;
    --orange:#EF7B2E;
    --orange-deep:#DA6A20;
    --orange-tint:#FFF8F3;
    --orange-tint-strong:#FFE9D8;
    --orange-border:#F3D8C2;
    --canvas:#F6F7FB;
    --ink:#171B2C;
    --muted:#667085;
    --faint:#9AA1B2;
    --line:#E9EBF2;
    --input-border:#DBDFEA;
    --green:#12875A;
    --green-tint:#E9F8EF;
  }
  *{box-sizing:border-box;}
  html,body{height:100%;}
  body{
    margin:0;
    background:var(--canvas);
    color:var(--ink);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    -webkit-font-smoothing:antialiased;
    display:flex;
    min-height:100vh;
  }
  h1,h2,h3{font-family:'Sora','Inter',sans-serif;}

  /* ---------- SIDEBAR ---------- */
  .sidebar{
    width:264px;
    flex-shrink:0;
    background:var(--sidebar);
    display:flex;
    flex-direction:column;
    position:fixed;
    left:0;
    top:0;
    height:100vh;
    overflow-y:auto;
    z-index:30;
    border-right:1px solid var(--sidebar-line);
    box-shadow:1px 0 0 rgba(15,21,38,0.02);
  }
  .sidebar::-webkit-scrollbar{width:6px;}
  .sidebar::-webkit-scrollbar-thumb{background:#E3E5EC;border-radius:99px;}

  .brand{
    display:flex;align-items:center;gap:12px;
    padding:26px 22px;
    border-bottom:1px solid var(--sidebar-line);
  }
  .brand-mark{
    width:42px;height:42px;border-radius:12px;
    background:linear-gradient(135deg, #F2924B, #EF7B2E);
    display:flex;align-items:center;justify-content:center;
    font-weight:800;font-size:15px;color:#fff;letter-spacing:-0.02em;
    flex-shrink:0;
    box-shadow:0 6px 16px -4px rgba(239,123,46,0.55);
    overflow:hidden;
  }
  .brand-mark img{ width:100%; height:100%; object-fit:cover; }
  .brand-text{display:flex;flex-direction:column;line-height:1.15;}
  .brand-text .name{font-family:'Sora',sans-serif;font-size:15px;font-weight:700;color:var(--ink);letter-spacing:-0.01em;}
  .brand-text .sub{font-size:11px;color:var(--sidebar-text);margin-top:3px;}

  .nav{padding:14px 12px 0;flex:1;display:flex;flex-direction:column;}
  .nav-group{margin-bottom:0;}
  .nav-label{
    font-size:10px;font-weight:700;letter-spacing:.08em;color:#A5ABBB;
    padding:14px 12px 6px;text-transform:uppercase;
  }
    .nav-item{
    display:flex;align-items:center;gap:11px;
    padding:9px 12px;margin-bottom:1px;border-radius:9px;
    font-size:13.5px;font-weight:500;color:var(--sidebar-text);
    cursor:pointer;text-decoration:none;
    transition:background .15s ease, color .15s ease, transform .1s ease;
    position:relative;
  }
  .nav-item i.nav-ico{width:17px;text-align:center;font-size:15.5px;opacity:.75;transition:opacity .15s, color .15s;}
  .nav-item:hover{background:var(--canvas);color:var(--ink);}
  .nav-item:hover i.nav-ico{opacity:1;}
  .nav-item.active{
    background:var(--orange-tint);
    color:var(--ink);
    font-weight:600;
    box-shadow:inset 0 0 0 1px var(--orange-border);
  }
  .nav-item.active::before{
    content:"";position:absolute;left:0;top:8px;bottom:8px;width:3px;
    background:var(--orange);border-radius:0 3px 3px 0;
  }
  .nav-item.active i.nav-ico{opacity:1;color:var(--orange);}
  .nav-item .chev{margin-left:auto;transition:transform .15s;opacity:.6;font-size:11px;}
  .nav-group.expanded > .nav-item .chev{transform:rotate(90deg);}

  .submenu{
    margin:0;
    padding:0 0 0 14px;
    overflow:hidden;max-height:0;transition:max-height .2s ease;
    list-style:none;
  }
  .nav-group.expanded .submenu{max-height:600px;}
  .submenu li{list-style:none;margin:0;padding:0;}
  .submenu .nav-item{padding-left:32px;font-size:13px;margin-bottom:1px;}
  .submenu .nav-item::before{display:none;}
  .submenu .nav-item.active{background:rgba(239,123,46,0.1);box-shadow:none;}
  .submenu .nav-item.active::before{display:block;}

  .sidebar-footer{
    padding:16px 22px;border-top:1px solid var(--sidebar-line);
    display:flex;align-items:center;gap:10px;
  }
  .sidebar-footer .dot{width:8px;height:8px;border-radius:99px;background:#2C9F5E;flex-shrink:0;}
  .sidebar-footer .txt{font-size:11.5px;color:var(--sidebar-text);}
  .sidebar-footer .txt b{color:var(--ink);font-weight:600;}

  /* ---------- MAIN ---------- */
  .main{flex:1;min-width:0;display:flex;flex-direction:column;margin-left:264px;}

  .topbar{
    display:flex;align-items:center;justify-content:space-between;gap:20px;
    padding:16px 32px;background:#fff;border-bottom:1px solid var(--line);
    box-shadow:0 1px 2px rgba(15,21,38,0.02);
    position:relative;z-index:5;
  }
  .topbar h3{font-size:19px;font-weight:700;letter-spacing:-0.01em;}
  .topbar-right{display:flex;align-items:center;gap:20px;}
  .topbar-user{display:flex;align-items:center;gap:9px;font-size:13.5px;color:var(--ink);font-weight:500;}
  .topbar-user .avatar{
    width:32px;height:32px;border-radius:99px;background:var(--canvas);
    display:flex;align-items:center;justify-content:center;color:var(--faint);
    border:1px solid var(--line);
  }
  .logout-form{display:inline;}
  .logout-btn{
    display:flex;align-items:center;gap:7px;
    background:#fff;color:#D5392F;border:1px solid #F5D3D0;
    font-size:13px;font-weight:600;padding:9px 16px;border-radius:9px;
    cursor:pointer;transition:background .15s,color .15s,border-color .15s;
  }
  .logout-btn:hover{background:#E9483F;color:#fff;border-color:#E9483F;}

  .menu-toggle{
    display:none;align-items:center;justify-content:center;
    width:36px;height:36px;border-radius:9px;border:1px solid var(--line);
    background:#fff;cursor:pointer;
  }

  .content-area{
    flex:1;
    padding:32px;
  }


  .card{
    background:#fff;border:1px solid var(--line);border-radius:16px;
    box-shadow:0 1px 2px rgba(15,21,38,0.03), 0 8px 24px -16px rgba(15,21,38,0.10);
    padding:24px;margin-bottom:20px;
  }

  @media (max-width:900px){
    .sidebar{transform:translateX(-100%);transition:transform .2s;z-index:40;}
    .sidebar.open{transform:translateX(0);box-shadow:20px 0 40px rgba(0,0,0,0.25);}
    .main{margin-left:0;}
    .menu-toggle{display:inline-flex;}
  }
</style>

@stack('styles')
</head>

<body>

<!-- ---------- SIDEBAR ---------- -->
<aside class="sidebar" id="sidebar">
  <div class="brand">
    <div class="brand-mark">
      <img src="{{ asset('images/logo.webp') }}" alt="EGTS Logo">
    </div>
    <div class="brand-text">
      <span class="name">EGTS Admin</span>
      <!-- <span class="sub">Energy Inspection Services</span> -->
    </div>
  </div>

  <nav class="nav">

    {{-- Dashboard --}}
    <div class="nav-group">
      <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid-1x2-fill nav-ico"></i>
        Dashboard
      </a>
    </div>

    <!-- <div class="nav-label">Homepage</div> -->

            <li class="has-submenu {{
                    request()->routeIs('admin.home.banner') ||
                    request()->routeIs('admin.home.banner.*') ||
                    request()->routeIs('admin.home.about') ||
                    request()->routeIs('admin.home.about.*') ||
                    request()->routeIs('admin.home.stats') ||
                    request()->routeIs('admin.home.stats.*') ||
                    request()->routeIs('admin.home.services.section') ||
                    request()->routeIs('admin.home.services.section.*') ||
                    request()->routeIs('admin.home.clients') ||
                    request()->routeIs('admin.home.clients.*') ||
                    request()->routeIs('admin.home.why-choose-us') ||
                    request()->routeIs('admin.home.why-choose-us.*')
                    ? 'open' : '' }}">
                <a onclick="toggleSubmenu(this)">
                    Home
                    <i class="bi bi-chevron-right chevron"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.home.banner') }}"
                            class="{{ request()->routeIs('admin.home.banner*') ? 'active' : '' }}">Banner Section</a>
                    </li>
                    <li><a href="{{ route('admin.home.about') }}"
                            class="{{ request()->routeIs('admin.home.about*') ? 'active' : '' }}">About Section</a></li>
                    <li><a href="{{ route('admin.home.stats') }}"
                            class="{{ request()->routeIs('admin.home.stats*') ? 'active' : '' }}">Stats Section</a></li>
                    <li><a href="{{ route('admin.home.services.section') }}"
                            class="{{ request()->routeIs('admin.home.services.section*') ? 'active' : '' }}">Service
                            Section</a></li>
                    <li><a href="{{ route('admin.home.clients') }}"
                            class="{{ request()->routeIs('admin.home.clients*') ? 'active' : '' }}">Client Section</a>
                    </li>
                    <li><a href="{{ route('admin.home.why-choose-us') }}"
                            class="{{ request()->routeIs('admin.home.why-choose-us*') ? 'active' : '' }}">Why Choose
                            Us</a>
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('admin.about') }}"
                    class="{{ request()->routeIs('admin.about') ? 'active' : '' }}">About</a></li>

            <li
                class="has-submenu {{ request()->routeIs('admin.service.banner') || request()->routeIs('admin.service.banner.*') ? 'open' : '' }}">
                <a onclick="toggleSubmenu(this)">
                    Services
                    <i class="bi bi-chevron-right chevron"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.service.banner') }}"
                            class="{{ request()->routeIs('admin.service.banner') || request()->routeIs('admin.service.banner.*') ? 'active' : '' }}">Banner</a>
                    </li>
                </ul>
            </li>

            <li
                class="has-submenu {{ request()->routeIs('admin.home.facility.banner') || request()->routeIs('admin.home.facility.banner.*') ? 'open' : '' }}">
                <a onclick="toggleSubmenu(this)">
                    Facility &amp; Capabilities
                    <i class="bi bi-chevron-right chevron"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.home.facility.banner') }}"
                            class="{{ request()->routeIs('admin.home.facility.banner') || request()->routeIs('admin.home.facility.banner.*') ? 'active' : '' }}">Banner</a>
                    </li>
                </ul>
            </li>

            <li
                class="has-submenu {{ request()->routeIs('admin.home.projects-clients.banner') || request()->routeIs('admin.home.projects-clients.banner.*') ? 'open' : '' }}">
                <a onclick="toggleSubmenu(this)">
                    Projects &amp; Clients
                    <i class="bi bi-chevron-right chevron"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.home.projects-clients.banner') }}"
                            class="{{ request()->routeIs('admin.home.projects-clients.banner') || request()->routeIs('admin.home.projects-clients.banner.*') ? 'active' : '' }}">Banner</a>
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('admin.home.contact-banner') }}"
                    class="{{ request()->routeIs('admin.home.contact-banner*') ? 'active' : '' }}">Contact Us</a></li>

            <li
                class="has-submenu {{
                    request()->routeIs('admin.home.services') ||
                    (request()->routeIs('admin.home.services.*') && !request()->routeIs('admin.home.services.section*')) ||
                    request()->routeIs('admin.home.services.behind-the-scenes*') ||
                    request()->routeIs('admin.home.facility.machines') ||
                    request()->routeIs('admin.home.facility.machines.*') ||
                    request()->routeIs('admin.home.facility.tools') ||
                    request()->routeIs('admin.home.facility.tools.*') ||
                    request()->routeIs('admin.home.masters.projects') ||
                    request()->routeIs('admin.home.masters.projects.*') ||
                    request()->routeIs('admin.home.projects') ||
                    request()->routeIs('admin.home.projects.*') ||
                    request()->routeIs('admin.home.certificates*')
                    ? 'open' : '' }}">
                <a onclick="toggleSubmenu(this)">
                    Masters
                    <i class="bi bi-chevron-right chevron"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.home.services') }}"
                            class="{{ request()->routeIs('admin.home.services') || (request()->routeIs('admin.home.services.*') && !request()->routeIs('admin.home.services.behind-the-scenes*') && !request()->routeIs('admin.home.services.section*')) ? 'active' : '' }}">Service</a>
                    </li>
                    <li><a href="{{ route('admin.home.services.behind-the-scenes') }}"
                            class="{{ request()->routeIs('admin.home.services.behind-the-scenes*') ? 'active' : '' }}">Behind
                            The Scene</a>
                    </li>
                    <li><a href="{{ route('admin.home.facility.machines') }}"
                            class="{{ request()->routeIs('admin.home.facility.machines') || request()->routeIs('admin.home.facility.machines.*') ? 'active' : '' }}">Machine</a>
                    </li>
                    <li><a href="{{ route('admin.home.facility.tools') }}"
                            class="{{ request()->routeIs('admin.home.facility.tools') || request()->routeIs('admin.home.facility.tools.*') ? 'active' : '' }}">Tool</a>
                    </li>
                    {{-- <li><a href="{{ route('admin.home.masters.projects') }}"
                            class="{{ request()->routeIs('admin.home.masters.projects') || request()->routeIs('admin.home.masters.projects.*') ? 'active' : '' }}">Project</a> --}}
                    </li>
                    <li><a href="{{ route('admin.home.projects') }}"
                            class="{{ request()->routeIs('admin.home.projects') || request()->routeIs('admin.home.projects.*') ? 'active' : '' }}">Client</a>
                    </li>
                    <li><a href="{{ route('admin.home.certificates') }}"
                            class="{{ request()->routeIs('admin.home.certificates*') ? 'active' : '' }}">Certificate</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

  </nav>

  <!-- <div class="sidebar-footer">
    <span class="dot"></span>
    <span class="txt">Synced &middot; <b>2 min ago</b></span>
  </div> -->
</aside>

<!-- ---------- MAIN ---------- -->
<div class="main">
  <div class="topbar">
    <button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
      <i class="bi bi-list"></i>
    </button>

    <h3>@yield('title')</h3>

    <div class="topbar-right">
      <div class="topbar-user">
        <span class="avatar"><i class="bi bi-person"></i></span>
        Welcome, {{ auth()->user()->name }}
      </div>
      <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>

  <div class="content-area">
    @yield('content')
  </div>
</div>

<script>
  function toggleSub(el){
    const group = el.closest('.nav-group');
    group.classList.toggle('expanded');
  }
</script>

@stack('scripts')

</body>
</html>