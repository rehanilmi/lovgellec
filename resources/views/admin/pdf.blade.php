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
			font-size: 6pt;
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
                <th style="padding: 10px;"> Invoice</th>
                <th style="padding: 10px;"> Tanggal</th>
                <th style="padding: 10px;"> Nama</th>
                <th style="padding: 10px;"> Email</th>
                <th style="padding: 10px;"> Alamat</th>
								<th style="padding: 10px;"> Phone</th>
								<th style="padding: 10px;"> Jumlah</th>
								<th style="padding: 10px;"> Total Belanja</th>
                <th style="padding: 10px;"> Status Pembayaran</th>
                <!-- <th style="padding: 10px;"> Status Pengiriman</th> -->
            </tr>
            </tr>
        </thead>

        <tbody>
            <tr>
							<td>{{ $order->id }}</td>
							<td>{{ $order->tanggal_order }}</td>
							<td>{{ $order->user-> name }}</td>
							<td>{{ $order->user-> email }}</td>
							<td>{{ $order->user-> address }}</td>
							<td>{{ $order->user-> phone }}</td>
							<td>{{ $order->count }}</td>
							<td>{{ number_format($order->total_belanja) }}</td>
							<td><b>
									@if ($order->payment_status == 1)
											Menunggu Pembayaran
									@elseif ($order->payment_status == 2)
											Sudah Dibayar
									@elseif ($order->payment_status == 3)
											COD
									@else
											Kadaluarsa
									@endif
							</b></td>
							<!-- <td>{{ $order->status }}</td> -->
            </tr>
        </tbody>
    </table>
</body>
</html>
