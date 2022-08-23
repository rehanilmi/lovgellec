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
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Phone</th>
                                <th>Jumlah</th>
                                <th>Total Belanja</th>
                                <th> Status Pembayaran</th>
                                <th> Status Pengiriman</th>
                                <th> Print PDF</th>
                                <th> Send Email</th>
                                <th> Keterangan</th>


                            </tr>
                            </thead>
                        <tbody>
                            @forelse($pesanan as $user => $order)
                            <tr>
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->tanggal_order }}</td>
                                    <td>{{ $order->user-> name }}</td>
                                    <td>{{ $order->user-> email }}</td>
                                    <td>{{ $order->user-> address }}</td>
                                    <td>{{ $order->user-> phone }}</td>
                                    <td>{{ $order->count }}</td>
                                    <td>{{ number_format($order->total_belanja) }}</td>
                                    <td>
                                        @if ($order->payment_status == 1)
                                        <a href="{{ url('bayar',$order->id) }}"
                                        onclick="return confirm('Apakah Produk Sudah Dibayar?!')"
                                        class="btn btn-primary">Belum Dibayar</a>
                                        @elseif ($order->payment_status == 2)
                                            Sudah Dibayar
                                        @elseif ($order->payment_status == 3)
                                            COD
                                        @else
                                            Kadaluarsa
                                        @endif
                                    </td>
                                    <td>  @if ($order->status == 'Sedang Diproses')
                                        <a href="{{ url('proses',$order->id) }}"
                                        onclick="return confirm('Apakah Produk Sudah Dikirim?!')"
                                        class="btn btn-primary">Sedang Diproses</a>
                                        @elseif ($order->status == 'Sudah Dikirim')
                                        <a href="{{ url('selesai',$order->id) }}"
                                        onclick="return confirm('Apakah Produk Sudah Diterima?!')"
                                        class="btn btn-primary">Sudah Dikirim</a>
                                        @else
                                            {{ $order->status }}
                                        @endif
                                    <td>
                                        <a href="{{ url ('print_pdf',$order->id) }}" class="btn btn-success">Print PDF</a>
                                    </td>

                                    <td>
                                        <a href="{{ url('send_email',$order->id) }}" class="btn btn-info">Send Email</a>
                                    </td>
                                    <td>
                                      <a href="{{ url('detail_order_adm',$order->id) }}" class="btn btn-info">Detail</a>
                                    </td>




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
