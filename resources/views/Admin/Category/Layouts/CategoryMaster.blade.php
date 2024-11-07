<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    @yield('title')
    <!-- bootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fontfaces CSS-->
    <link href="{{asset('Admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('Admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('Admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('Admin/css/theme.css')}}" rel="stylesheet" media="all">

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#" >
                    <img src="{{asset('/Admin/images/Slice Of Heaven.avif')}}" class="rounded-circle" alt="Cool Admin" style="width: 70px;height:60px;border-radius: 20px"/>
                   <span class="text-dark fw-bold">  Slice Of Heaven</span>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class=" has-sub">
                            <a href="{{route('Category#lists')}}">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li class=" has-sub">
                            <a class="js-arrow" href="{{ route('Admin#ProductsLists')}}">
                                <i class="fas fa-tachometer-alt"></i>Products
                            </a>
                        </li>
                        <li>
                            <a href="{{route('Order#List')}}">
                                <i class="fas fa-chart-bar"></i>Order Lists</a>
                        </li>
                        <li>
                            <a href="{{ route('Admin#ListPage')}}">
                                <i class="fa-solid fa-list-ul"></i>Admin Lists</a>
                        </li>
                        <li>
                            <a href="{{route('User#ListPage')}}">
                                <i class="fas fa-chart-bar"></i>User Lists</a>
                        </li>
                        <li>
                            <a href="{{route('Customer#MessageLists')}}">
                                <i class="fas fa-chart-bar"></i>Customer message lists</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap ">
                           <h2> Admin DashBoard </h2>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                <img src="{{asset('/Admin/images/default_image.jpg')}}"  class=" rounded-circle"  alt="..."/>
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class=" rounded-circle" alt="..."/>
                                            @endif />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                        <img src="{{asset('/Admin/images/default_image.jpg')}}"  class=" rounded-circle"  alt="John Doe"/>
                                                    @else
                                                        <img src="{{asset('storage/'.Auth::user()->image)}}" class=" rounded-circle" alt="John Doe"/>
                                                    @endif />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('Admin#AccountPage')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>


                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('Admin#PasswordPage') }}">
                                                        <i class="fa-solid fa-lock"></i>Password Change</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                              <form action="{{ route('logout')}}" method="POST" class="text-center" >
                                                @csrf
                                                <button type="submit" class="btn btn-dark color-white w-100" >
                                                    <i class="zmdi zmdi-power"></i>Logout
                                                </button>
                                              </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

          @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <!-- bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Jquery JS-->
    <script src="{{ asset('Admin/vendor/jquery-3.2.1.min.js')}}"></script>

    <!-- Bootstrap JS-->
    <script src="{{ asset('Admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('Admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('Admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('Admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('Admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('Admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('Admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('Admin/js/main.js')}}"></script>
    @yield('Script')

</body>

</html>
<!-- end document-->
