<header class="header_section">
    <body class="goto-here">
        <div class="py-1 bg-info">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">lovegellshop@gmail.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">handmade with love &amp; just for you </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="100" src="/images/logo.png" alt="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="" class="nav-link">  </a></li>
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ url ('products') }}" class="nav-link">Product</a></li>
                    <li class="nav-item"><a href="{{ url('show_order') }}" class="nav-link">Order</a></li>
                    <li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
                    <li class="nav-item cta cta-colored"><a href="{{ url('show_cart') }}" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
    
                    @if (Route::has('login'))
                    
                    @auth
                    <li class="nav-link">
                        <x-app-layout>
                        </x-app-layout>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>