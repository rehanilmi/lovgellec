@include('home.header')

<section class="ftco-section">
   <div class="container">
         <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
         <h2 class="mb-4" style="background-color:mistyrose">Our Products</h2>
         </div>
      </div>

      @if(session()->has('message'))
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert"
         aria-hidden="true">x</button>
         {{ session()->get('message') }}
      </div>
      @endif

      
      <div class="row">
         @foreach ($product as $products)
         <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
               <a href="#" class="img-prod"><img class="img-fluid" src="product/{{ $products->image }}" alt="" alt="Colorlib Template">
                  <div class="overlay"></div>
               </a>
               <div class="text py-3 pb-4 px-3 text-center">
                  <h3><a href="#">{{ $products->title }}</a></h3>
                  <div class="d-flex">
                     <div class="pricing">
                        <p class="price"><span>Rp. {{ number_format ($products->price) }}</span></p>
                     </div>
                  </div>
                  <div class="bottom-area d-flex px-3">
                     <div class="m-auto d-flex">
                        <a href="{{ url('product_details', $products->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                           <span><i class="ion-ios-menu"></i></span>
                        </a>
                     </div>
                  </div>
               </div>

               <form action="{{ url ('add_cart', $products->id) }}" method="Post">
                  @csrf
                  <div class="bottom-area d-flex px-6">
                     <div class="m-auto d-flex">
                        <input type="number" name="quantity"
                        value="1" min="1" style="width: 100px">
                     </div>
                     <div class="m-auto d-flex">
                        <button type="submit" class="btn btn-black"> + </button>
                     </div>
                  </div>
               </form>

            </div>
         </div>
         @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@include('home.footer')