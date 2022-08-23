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
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $totalbelanja=0;
                        ?>
                        @foreach($cart as $cart)
                        <?php
                          $totalprice = $cart["price"] * $cart["quantity"]
                        ?>
                        <tr class="text-center">

                            <td>{{$no++}}</td>

                            <td class="image-prod"><img class="img" src="/product/{{ $cart["image"]}}"></td>

                            <td class="product-name">
                                <h3>{{ $cart-> product_title }}</h3>
                            </td>

                            <td class="price">
                                <h3>Rp. {{ number_format ($cart["price"])}} </h3>
                            </td>

                            <td class="quantity">
                                <div class="text-center">
                                <h3>{{ $cart["quantity"]}} Pcs </h3>
                            </div>
                            </td>

                            <td class="total"> Rp. {{ number_format ($totalprice) }} </td>

                        <td class="product-remove"><a href="{{ url ('remove_cart',$cart->id) }}"
                            onclick="return confirm('Are you sure to remove the product?')">
                            <span class="ion-ios-close"></span></a></td>

                    </tr><!-- END TR-->

                    <?php
                        $totalbelanja+= $totalprice;
                    ?>

                    @endforeach
                </table>
        <!--<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
            <h3>Cek Ongkir</h3>
            <a href="{{ url ('ongkir') }}"  class="btn btn-danger"> Tambahkan Ongkir </a>
            </div>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Metode Pembayaran</h3>
                <a href="{{ url ('cash_order') }}" onclick="return confirm('Are you sure to order?')" class="btn btn-danger" style="margin-bottom: 10px;"> Cash On Delivery </a>
                <a href="{{ url ('payment') }}" class="btn btn-danger"> Virtual Account Billing </a>
            </div>
        </div> -->
<form class="forms-sample" action="{{ url('/checkout') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                    <span>Total Belanja : Rp. {{ number_format ($totalbelanja)}}</span>
                    <input type="hidden" value="{{$totalbelanja}}" class="form-control" name="totalbelanja" id="totalbelanja">
                </p>
            </div>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate ">
        <label>Metode Pembayaran<span>*</span>
        </label>
        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
        <option value="">Metode Pembayaran</option>
        <option value="COD">Cash On Delivery (COD)</option>
        <option value="Transfer">Transfer</option>
        </select>
        <span id="selected" name="selected"></span>
        <!-- <input type="text" class="form-control" id="metodepembayaran" name="metodepembayaran" placeholder="ini untuk menangkap nama kota"> -->
        </div>
        <div class="div_design">
            <input type="submit" value="checkout" class="btn btn-primary">
        </div>

    </form>




        </div>
    </div>
    @endif
</section>

@include('home.script')
<script>
$(document).ready(function(){

    });

</script>
