@include('home.css')
@include('home.header')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <img src="/product/{{ $product->image }}" class="img-fluid" alt="Colorlib Template"></a>
            </div>
<br> </br>

            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3> {{ $product->title }} </h3>
                <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <!-- <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p> -->
                    </div>

                    <br> </br> <br> </br>
                <p class="price"><span>Rp. {{ number_format ($product->price) }}</span></p>
                <p>{{ $product->description }}
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                <div class="select-wrap">
                </div>
                </div>
                        </div>
            <br> </br> <br> </br>
        </div>

        <form action="{{ url ('add_cart', $product->id) }}" method="Post">
            @csrf
            <div class="row">
            <div class="col-md-4">
                <input type="number" name="quantity"
                value="1" min="1" style="width: 100px">
            </div>
            
            <div class="col-md-4">
                <input type="submit" class="btn btn-black" value="add To Cart">
            </div>
            </div>
        </form>
            </div>
        </div>
    </div>
</section>

@include('home.script')