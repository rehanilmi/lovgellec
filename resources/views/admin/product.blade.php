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
            <div style="padding-left: 50px; padding-right: 50px;">

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
                <h3>Tambah Produk </h3>
                <br>
            </br>
                <form class="forms-sample" action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Nama Produk</label>
                        <input type="text" class="form-control" name="title" id="exampleInputName1"placeholder="Masukkan Nama" required="">
                    </div>

                <div class="form-group">
                    <label for="exampleInputName1">Deskripsi</label>
                    <input type="text" class="form-control" name="description" id="exampleInputName1" placeholder="Masukkan Deskripsi" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Harga</label>
                    <input type="text" class="form-control" name="price" id="exampleInputName1" placeholder="Masukkan Harga" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Jumlah Produk</label>
                    <input type="text" class="form-control" name="quantity" id="exampleInputName1" placeholder="Masukkan Jumlah Produk" required="">
                </div>

                <div class="form-group">
                    <label class="col-12 grid-margin stretch-card">Kategori</label>
                    
                    <select class="text_color" name="category" required="">
                        <option value="" selected="" > Pilih kategori </option>
                    
                        @foreach($category as $category)
                        
                        <option value="{{ $category->category_name }}">
                        {{ $category->category_name }} </option>
                        
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label> Gambar Produk </label>
                    <input type="file" name="image" required="">
                </div>
                <br>
            </br>
                <div class="div_design">
                    <input type="submit" value="Add Product" class="btn btn-primary">
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