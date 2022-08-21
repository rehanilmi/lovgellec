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
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
                
                <div class="card">
                <div class="card-body">
                    <h3>Tambah Kategori</h3>
                    <br> </br>
                    <form action="{{ url('/add_category') }}" method="POST">
                        @csrf
                        <input class="col-12 grid-margin" type="text" name="category" placeholder="Masukkan kategori baru" required="">
                        <input type="submit" value="Add" class="btn btn-primary" >
                    </div>
                    </form>
                </div>        
                
<br>

</br>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Kategori</th>
                                <th> Aksi</th>
                            </tr>
                            </thead>
                            
                        <tbody>
                            @foreach($data as $data)
                    
                    <tr>
                        <td>{{ $data->category_name }}</td>
                    
                    <td class="center">
                        <a onclick="return confirm('Are You Sure to Delete this?')" class="btn btn-danger" href="{{ url ('delete_category',$data->id) }}">Delete</a>
                    </td>
                    
                    </tr>
                    
                    @endforeach
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