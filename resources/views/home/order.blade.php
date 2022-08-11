@include('home.css')
@include('home.header')

    <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                
                                <th> Image</th>
                                <th> Product Name</th>
                                <th> Quantity</th>
                                <th> Price</th>
                                <th> Payment Status</th>
                                <th> Delivery Status</th>
                                <th> Cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $order)

                                <td>
                                    <img height="100" width="180" src="product/{{ $order->image }}">
                                </td>
                                
                                <td> {{ $order->product_title }} </td>
                                <td> {{ $order->quantity }} </td>
                                <td> {{ $order->price }} </td>
                                <td> {{ $order->payment_status }} </td>
                                <td> {{ $order->delivery_status }} </td>
                                
                                <td>
                                    @if($order->delivery_status=='processing')
                                    <a onclick="return confirm('Are You Sure to Cancel This Order?')" class="btn btn-danger"
                                    href="{{ url('cancel_order', $order->id) }}">Cancel Order</a>
                                    @else
                                    <p style="color: blue;" class="btn btn-info"> Not Allowed </p>
                                    @endif
                                </td>
                                
                            </tr><!-- END TR-->
                            @endforeach
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
                                <td class="image-prod"><div class="img" style="background-image:url(images/product-2.jpg);"></div></td>
                                <td class="product-name">
                                    
                                </td>
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                </div>
                            </td>
                            </tr><!-- END TR-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
        <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
            <span>Get e-mail updates about our latest shops and special offers</span>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
            <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
            </div>
            </form>
        </div>
        </div>
    </div>
    </section>

@include('home.footer')
@include('home.script')