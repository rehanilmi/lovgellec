<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
        @page
        {
        size: a4 landscape;
        }

	<center>
		<h5>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
		<h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5>
	</center>

	<table class='table table-bordered'>
        <thead>
            <tr>
                <th style="padding: 10px;"> Customer Name</th>
                <th style="padding: 10px;"> Customer Email</th>
                <th style="padding: 10px;"> Customer Phone</th>
                <th style="padding: 10px;"> Customer Address</th>
                <th style="padding: 10px;"> Customer Id</th>
                <th style="padding: 10px;"> Product Name</th>
                <th style="padding: 10px;"> Product Price</th>
                <th style="padding: 10px;"> Product Quantity</th>
                <th style="padding: 10px;"> Payment Status</th>
                <th style="padding: 10px;"> Product Id</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>  {{ $order->name }} </td>
                <td>  {{ $order->email }} </td>
                <td> {{ $order->phone }} </td>
                <td>  {{ $order->address }} </td>
                <td> {{ $order->user_id }} </td>

                <td> {{ $order->product_title }} </td>

                <td> {{ $order->price }} </td>
                <td> {{ $order->quantity }} </td>
                <td> {{ $order->payment_status }} </td>
                <td> {{ $order->product_id }} </td>
            </tr>
        </tbody>
    </table>

<img height="250" width="450" src="product/{{ $order->image }}">



</body>
</html> 