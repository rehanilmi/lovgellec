<div class="main-panel">
  <div class="content-wrapper">
      <div class="page-header">
          <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
          </span> Dashboard
          </h3>
      <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
      </nav>
      </div>
      <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Total Product <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{ $total_product }}</h2>
              
          </div>
          </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Total Order<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{ $total_order }}</h2>
              
          </div>
          </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Total Customer<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{ $total_user }}</h2>
              
          </div>
          </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Total Revenue<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">Rp.{{ $total_revenue }}</h2>
              
          </div>
          </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Order Delivered<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{ $total_delivered }}</h2>
              
          </div>
          </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
              
              <h4 class="font-weight-normal mb-3">Order Processing<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">{{ $total_processing }}</h2>
          </div>
          </div>
      </div>
      </div>
  </div>
</div>
</div>