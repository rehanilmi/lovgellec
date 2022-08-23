<!DOCTYPE html>
<html lang="en">
    <head>
    @include('admin.includes.header')
    </head>
<body>
    <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.includes.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.includes.sidebar')
    <!-- partial -->

    <div class="main-panel">
        <div class="content-wrapper">
            <div style="padding-left: 400px; padding-bottom: 30px;">
                <!-- <form action="{{ url('search') }}" method="get">
                    @csrf
                    <input type="text" style="color: black;" name="search"
                    placeholder="Search For Something">
                    <input type="submit" value="Search"
                    class="btn btn-outline-primary">
                </form> -->
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <h3> Semua Pesanan </h3>
                        <br>
                    </br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                              <th> Nama</th>
                              <th> Email</th>
                              <th> Alamat</th>
                              <th> Gambar</th>
                              <th> Nama Produk</th>
                              <th> Jumlah</th>
                              <th> Harga</th>


                            </tr>
                            </thead>
                        <tbody>
                            @forelse($order as $user => $order)
                            <tr>
                                <tr>
                                  <td>{{ $order->user->name }}</td>
                                  <td>{{ $order->user->email }}</td>
                                  <td>{{ $order->user->address }}</td>
                                  <td>
                                    <img height="100" width="180" src="/product/{{ $order->image }}">
                                  </td>
                                  <td>{{ $order->product_title }} </td>
                                  <td>{{ $order->quantity }} </td>
                                  <td> Rp.{{ number_format ($order->price) }} </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="16">
                                        Data not Found
                                    </td>
                                </tr>
                                @endforelse
                        </tbody>
                        </table>


    <!-- partial:partials/_footer.html -->

    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.includes.script')
</body>
</html>
