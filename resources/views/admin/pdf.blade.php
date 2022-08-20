<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th
        {
			font-size: 9pt;
		}
	</style>

	<center>
        <!-- <img width="100" src="/images/logo.png" alt="#"> -->
		<h5>Pengiriman</h4>
		<br> </br>
	</center>

	<table class='table table-bordered'>
        <thead>
            <tr>
                <th style="padding: 10px;"> Id</th>
                <th style="padding: 10px;"> Nama</th>
                <th style="padding: 10px;"> Email</th>
                <th style="padding: 10px;"> No. HP</th>
                <th style="padding: 10px;"> Alamat</th>
                
                <th style="padding: 10px;"> Id Produk</th>
                <th style="padding: 10px;"> Produk</th>
                <th style="padding: 10px;"> Harga</th>
                <th style="padding: 10px;"> Jumlah</th>
                <th style="padding: 10px;"> Status Pembayaran</th>
                <th style="padding: 10px;"> Gambar</th>
            </tr>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td> {{ $order->user_id }} </td>
                <td> {{ $order->name }} </td>
                <td> {{ $order->email }} </td>
                <td> {{ $order->phone }} </td>
                <td> {{ $order->address }} </td>

                <td> {{ $order->product_id }} </td>
                <td> {{ $order->product_title }} </td>
                <td> Rp. {{ number_format ($order->price) }} </td>
                <td> {{ $order->quantity }} </td>
                <td> {{ $order->payment_status }} </td>
                <td> <img height="40" width="55" src="product/{{ $order->image }}"> </td>
            </tr>
        </tbody>
    </table>
</body>
</html> 