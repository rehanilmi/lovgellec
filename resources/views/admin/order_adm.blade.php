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
                <form action="{{ url('search') }}" method="get">
                    @csrf
                    <input type="text" style="color: black;" name="search"
                    placeholder="Search For Something">
                    <input type="submit" value="Search"
                    class="btn btn-outline-primary">
                </form>
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
                                <th> Phone</th>
                                <th> Nama Produk</th>
                                <th> Jumlah</th>
                                <th> Harga</th>
                                <th> Status Pembayaran</th>
                                <th> Status Pengiriman</th>
                                <th> Gambar</th>
                                <th> Print PDF</th>
                                <th> Send Email</th>
                                <th> Keterangan</th>


                            </tr>
                            </thead>
                        <tbody>
                            @forelse($pesanan as $order)
                            <tr>
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->delivery_status }}</td>

                                    <td>
                                        <img class="img_size" src="/product/{{ $order->image }}">
                                    </td>

                                    <td>
                                        <a href="{{ url ('print_pdf',$order->id) }}" class="btn btn-success">Print PDF</a>
                                    </td>

                                    <td>
                                        <a href="{{ url('send_email',$order->id) }}" class="btn btn-info">Send Email</a>
                                    </td>

                                    <!-- aksi -->
                                    <td>
                                        @if($order->delivery_status=='processing')
                                        <a href="{{ url('delivered',$order->id) }}"
                                            onclick="return confirm('Are you sure this product is delivered?!')"
                                            class="btn btn-primary">Delivered</a>

                                        @else
                                        <p style="color:green;"> Delivered</p>

                                        @endif
                                    </td>
                                    <!-- aksi selesai-->

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
