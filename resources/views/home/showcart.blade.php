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
        <div class="row">
        <div class="col-md-12 ftco-animate">
            <div class="cart-list">
                <table class="table">
                    <thead class="thead-primary">
                        <tr class="text-center">
                            <th>Remove</th>
                            <th>Gambar</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalprice=0; ?>
                        @foreach($cart as $cart)
                        <tr class="text-center">

                            <td class="product-remove"><a href="{{ url ('remove_cart',$cart->id) }}"
                                onclick="return confirm('Are you sure to remove the product?')">
                                <span class="ion-ios-close"></span></a></td>

                            <td class="image-prod"><img class="img" src="/product/{{$cart->image}}"></td>


                            <td class="product-name">
                                <h3>{{ $cart->product_title }} </h3>
                                <p> {{ $cart->description }} </p>
                            </td>

                            <td class="price">
                                <h3>Rp. {{ $cart->price }} </h3>
                            </td>

                            <td class="quantity">
                                <div class="text-center">
                                <h3>{{ $cart->quantity }} </h3>
                            </div>
                        </td>

                        <?php $totalprice=$totalprice + $cart->price ?>
                        <td class="total"> {{ $totalprice }} </td>

                    </tr><!-- END TR-->

                    @endforeach
                </table>


        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                    <span>Total</span>
                    <span> Rp. {{ $totalprice }}</span>
                </p>

            </div>

                <a href="{{ url('cash_order') }}" class="btn btn-danger"> Cash On Delivery</a>

                <a href="{{ url ('payment') }}" class="btn btn-danger"> Virtual Account Billing </a>


                </div>
        </div>
</section>

@include('home.script')
