    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
            <div class="nav-profile-image">
                <img src="/images/logo.png" alt="#" />
                <span class="login-status online"></span>
    <!--change to offline or busy as needed-->
            </div>

            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/redirect') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Data Produk</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                
                <li class="nav-item"> <a class="nav-link" href="{{ url('/show_product') }}"> Semua Produk</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('view_category')}}"> Kategori Produk</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/view_product') }}"> Tambah Produk</a></li>
                
                </ul>
            </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('order') }}">
                    <span class="menu-title">Pesanan</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ url('laporan') }}">
                    <span class="menu-title">Cetak Laporan</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li> -->

        </ul>
    </nav>