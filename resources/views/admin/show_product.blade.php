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
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h3>Semua Produk</h3>
                            <br>
                        </br>
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Nama Produk </th>
                                    <th> Deskripsi </th>
                                    <th> Jumlah </th>
                                    <th> Kategori </th>
                                    <th> Harga </th>
                                    <th> Gambar </th>
                                    <th> Delete </th>
                                    <th> Update </th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                <tr>
                                    @foreach ($product as $product)
                                    
                                    <tr>
                                        <td> {{ $product->title }} </td>
                                        <td> {{ $product->description }} </td>
                                        <td> {{ $product->quantity }} </td>
                                        <td> {{ $product->category }} </td>
                                        <td> {{ $product->price }} </td>
                                        
                                        <td> 
                                            <img class="img_size" src="/product/{{ $product->image }}">
                                        </td>
                                        
                                        <td>
                                            <a class="btn btn-danger" onclick="return confirm('Are you Sure to Delete This?')" href="{{ url('delete_product', $product->id) }}"> Delete </a>
                                        </td>
                                        
                                        <td>
                                            <a class="btn btn-success" href="{{url ('update_product', $product->id)}}"> Update </a>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
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