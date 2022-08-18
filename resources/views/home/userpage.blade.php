<!DOCTYPE html>
<html>
   <head>
      @include('home.css')
   </head>
   <body>

      @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      
      <!-- why section -->
      <!-- @include('home.why') -->
      <!-- end why section -->
      
      <!-- arrival section -->
      <!-- @include('home.new_arrival') -->
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
      <!-- end product section -->
      
      <!-- subscribe section -->
      <!-- @include('home.client') -->
      <!-- end subscribe section -->
      
      <!-- client section -->
      @include('home.subscribe')
      <!-- end client section -->
      
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      
      <!-- <div class="cpy_">
         <p class="mx-auto">© 2022 LoveGell Shop</a><br>
            All Rights Reserved </a>
         </p>
      </div> -->

<!-- jQery -->
<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
<script src="{{ asset ('home/js/jquery.min.js') }}"></script>
<script src="{{ asset ('home/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset ('home/js/popper.min.js') }}"></script>
<script src="{{ asset ('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('home/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset ('home/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset ('home/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset ('home/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset ('home/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset ('home/js/aos.js') }}"></script>
<script src="{{ asset ('home/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset ('home/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset ('home/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset ('home/js/google-map.js') }}"></script>
<script src="{{ asset ('home/js/main.js') }}"></script>
   </body>
</html>