@include('home.css')
@include('home.header')

<!--
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
            </div>
        </div>
    </div>
</div> -->

<section class="ftco-section ftco-cart">
    <div class="container">
        @if(empty($cart) || count($cart) ==0 )
        <center><p>tidak ada product di cart</p></center>
        @else
        <div class="row">
        <div class="col-md-12 ftco-animate">
            <div class="cart-list">
                <table class="table">
                    <thead class="thead-primary">
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $totalbelanja=0;
                        ?>
                        @foreach($cart as $ct => $val)
                        <?php
                          $totalprice = $val["price"] * $val["quantity"]
                        ?>
                        <tr class="text-center">

                            <td>{{$no++}}</td>

                            <td class="image-prod"><img class="img" src="/product/{{ $val["image"]}}"></td>


                            <td class="product-name">
                                <h3>{{ $val["product_title"]}} </h3>
                                <p> {{ $val["description"]}} </p>
                            </td>

                            <td class="price">
                                <h3>Rp. {{ $val["price"]}} </h3>
                            </td>

                            <td class="quantity">
                                <div class="text-center">
                                <h3>{{ $val["quantity"]}} Pcs </h3>
                            </div>
                            </td>

                            <td class="total"> Rp. {{ $totalprice }} </td>

                        <td class="product-remove"><a href="{{ url ('remove_cart',$val->id) }}"
                            onclick="return confirm('Are you sure to remove the product?')">
                            <span class="ion-ios-close"></span></a></td>

                    </tr><!-- END TR-->

                    <?php
                      $totalbelanja+= $totalprice;
                     ?>

                    @endforeach
                </table>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
            <h3>Cek Ongkir</h3>
            <a href="{{ url ('ongkir') }}"  class="btn btn-danger"> Tambahkan Ongkir </a>
          </div>
        </div>

        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                    <span>Biaya Ongkir </span>
                    <span> Rp. {{ $totalbelanja }}</span>
                </p>
                <p class="d-flex">
                    <span>Total Semua</span>
                    <span> Rp. {{ $totalbelanja }}</span>
                </p>
            </div>
        </div>

        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
              <h3>Metode Pembayaran</h3>
              <a href="{{ url ('cash_order') }}" onclick="return confirm('Are you sure to order?')" class="btn btn-danger" style="margin-bottom: 10px;"> Cash On Delivery </a>
              <a href="{{ url ('payment') }}" class="btn btn-danger"> Virtual Account Billing </a>
            </div>
        </div>

      </div>
   </div>
    @endif
</section>

@include('home.script')
