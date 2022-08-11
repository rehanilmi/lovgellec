<section class="ftco-section">
      <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
         <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Products</h2>
            <span class="subheading">Made With Love</span>
   <br> </br>
            <form action="{{ url('product_search') }}" method="GET">
                  @csrf
                  <input style="width: 500px;" type="text" name="search" placeholder="Search For Something">
                  <input type="submit" value="search">
                  </form>
            </div>
         </div>   		
      </div>

         @if(session()->has('message'))
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
            {{ session()->get('message') }}
         </div>
         @endif
         
         <div class="container">
         <div class="row">
         
            @foreach ($product as $products)
            
            <div class="col-md-6 col-lg-3 ftco-animate">
               <div class="product">
                  <div class="product">
                     <a href="#" class="img-prod"><img class="img-fluid" src="product/{{ $products->image }}" alt="Colorlib Template">
                        <div class="overlay"></div>
                     </a>

                     <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{ $products->title }}</a></h3>
                        <div class="d-flex">
                           <div class="pricing">
                                 <p class="price"></span><span class="price-sale">{{ $products->price }}</span></p>
                           </div>
                        </div>

                        <div class="bottom-area d-flex px-3">
                           <div class="m-auto d-flex">
                              <a href="{{ url('product_details', $products->id) }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                 <span> <i class="ion-ios-menu"></i> </span>
                                 
                              </a>
                           </div>

                           

                           <form action="{{ url ('add_cart', $products->id) }}" method="Post">
                              @csrf
                              <div class="row">
                                 <div class="m-auto d-flex">
                                    <input type="number" name="quantity"
                                    value="1" min="1" style="width: 100px">
                                 </div>
                                 
                                 <div class="m-auto d-flex">
                                    <button type="submit" class="btn btn-success"> + </button>
                                    
                                 </div>
                              </div>
                           </form>

                        

                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
            @endforeach
         </div>
   </section>