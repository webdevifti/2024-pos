<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('dashboard/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('dashboard/css/toastr.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       
    </head>
    <body class="sb-nav-fixed">
        @auth
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('home') }}">
                {{ get_option('site_name') }}
            </a>
            <!-- Sidebar Toggle-->
          
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> --}}
            <div class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        @if(Auth::user()->role == 'owner')
                        <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
                        @endif
                        <li><hr class="dropdown-divider" /></li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                    </ul>
                </li>
            </ul>
        </nav>
        @endauth
        <div id="layoutSidenav">
           @auth
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                          
                            <a class="nav-link {{ (request()->is('home') ? 'active': '') }}" href="{{ route('home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                           
                            <a class="nav-link {{ (request()->is('pos/orders') ? 'active': '') }}" href="{{ route('pos.order') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Pos
                            </a>
                           
                            <a class="nav-link {{ (request()->is('/orders') ? 'active': '') }}" href="{{ route('orders.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Orders
                            </a>
                           
                            <a class="nav-link {{ (request()->is('products') ? 'active': '') }}" href="{{ route('products.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                                Products
                            </a>
                            

                            @if(Auth::user()->role == 'owner')
                            <a class="nav-link {{ (request()->is('users') ? 'active': '') }}" href="{{ route('users.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users / Employees
                            </a>
                            <a class="nav-link {{ (request()->is('customers') ? 'active': '') }}" href="{{ route('customers.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Customer
                            </a>
                            <a class="nav-link {{ (request()->is('companies') ? 'active': '') }}" href="{{ route('companies.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Companies
                            </a>
                            @endif
                            <a class="nav-link {{ (request()->is('settings') ? 'active': '') }}" href="{{ route('settings.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Settings
                            </a>
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth()->user()->name }}
                    </div>
                </nav>
            </div>
            @endauth
            <div id="layoutSidenav_content">
                @yield('content')
                @auth
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; developed by <a href="https://webdevifti.com">webdevifti</a> 2023 - {{ date('Y') }}</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                @endauth
            </div>
        </div>
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('dashboard/assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/datatables-simple-demo.js') }}"></script>

        <script src="{{ asset('dashboard/js/toastr.min.js') }}"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @yield('footer_script')
    </body>
</html>
