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
            <div style="padding-left: 150px; padding-right: 150px;">

                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2>Update Produk </h2>
                <br>
            </br>
                <form
                action="{{ url('/update_product_confirm', $product->id) }}"
                method="POST" enctype="multipart/form-data">
                
                @csrf

                <div class="form-group">
                    <label for="exampleInputName1">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleInputName1"placeholder="Masukkan Nama"
                    name="title" value="{{ $product->title }}" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Deskripsi</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Masukkan Deskripsi"
                    name="description" value="{{ $product->description }}" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Harga</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Masukkan Harga"
                    name="price" value="{{ $product->price }}" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Jumlah Produk</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Masukkan Jumlah Produk"
                    min="0" name="quantity" value="{{ $product->quantity }}" required="">
                </div>


                <div class="form-group">
                    <label class="col-12 grid-margin stretch-card">Kategori</label>
                    
                    <select class="text_color" name="category" required="">
                        <option value="{{ $product->category }}" selected="">
                        {{ $product->category }}</option>
                        
                        @foreach($category as $category)
                        
                        <option value="{{ $category->category_name }}">
                        {{ $category->category_name }} </option>
                        
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label> Gambar Produk </label>
                    <img style="margin:left;" height="100" width="100"
                    src="/product/{{ $product->image }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1"> Gambar produk baru </label>
                    <input type="file" name="image">
                </div>

                <br>
            </br>

                <div class="div_design">
                    <input type="submit" value="Update Product" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

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