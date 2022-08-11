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