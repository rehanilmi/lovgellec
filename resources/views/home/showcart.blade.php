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
        <!-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
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

        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <label for="provinsi">Provinsi Tujuan</label>
        <select name="province_id" id="province_id" class="form-control">
        <option value="">Provinsi Tujuan</option>
        @foreach ($provinsi  as $row)
        <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
        @endforeach
        <input type="hidden" class="form-control" id="nama_provinsi" nama="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
        </select>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <label>Kota Tujuan<span>*</span>
        </label>
        <select name="kota_id" id="kota_id" class="form-control">
        <option value="">Pilih Kota</option>
        </select>
        <input type="hidden" class="form-control" id="nama_kota" name="nama_kota" placeholder="ini untuk menangkap nama kota">
        </div>

        <div class="col-lg-4 mt-5 cart-wrap ftco-animate ">
        <label>Pilih Ekspedisi<span>*</span>
        </label>
        <select name="kurir" id="kurir" class="form-control">
        <option value="">Pilih kurir</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
        <option value="pos">POS INDONESIA</option>
        </select>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <label>Pilih Layanan<span>*</span>
        </label>
        <select name="layanan" id="layanan" class="form-control">
        <option value="">Pilih layanan</option>
        </select>
        </div>

        <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                  <span>Total Belanja : Rp.{{$totalbelanja}}</span>
                  <input type="hidden" value="{{$totalbelanja}}" class="form-control" name="totalbelanja" id="totalbelanja">
                </p>
                <p class="d-flex">
                 Ongkos Kirim  : Rp <span id="ongkoskirim" name="ongkoskirim"></span>
                </p>
                <p class="d-flex">
                Total &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: Rp <span id="total" name="total"></span>
               </p>
            </div>
        </div>




      </div>
   </div>
    @endif
</section>

@include('home.script')
<script>
$(document).ready(function(){
    //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
    //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
    $('select[name="province_id"]').on('change', function(){
        var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
        $("#nama_provinsi").val(namaprovinsiku);
        // kita buat variable provincedid untk menampung data id select province
        let provinceid = $(this).val();
        //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
        if(provinceid){
            // jika di temukan id nya kita buat eksekusi ajax GET
            jQuery.ajax({
                // url yg di root yang kita buat tadi
                url:"/kota/"+provinceid,
                // aksion GET, karena kita mau mengambil data
                type:'GET',// type data json
                dataType:'json',// jika data berhasil di dapat maka kita mau apain nih
                success:function(data)
                {
                    console.log(data);
                    $('select[name="kota_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="kota_id"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                    });
                }
            });
        }else {
            $('select[name="kota_id"]').empty();
        }
    });
    $('select[name="kota_id"]').on('change', function(){
        // membuat variable namakotaku untyk mendapatkan atribut nama kota
        var namakotaku = $("#kota_id option:selected").attr("namakota");
        // menampilkan hasil nama provinsi ke input id nama_provinsi
        $("#nama_kota").val(namakotaku);
    });
});
$('select[name="kurir"]').on('change', function(){
    let origin = $("input[name=city_origin]").val();
    let destination = $("select[name=kota_id]").val();
    let courier = $("select[name=kurir]").val();
    let weight = $("input[name=weight]").val();
    if(courier){
        jQuery.ajax({
            url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
            type:'GET',
            dataType:'json',
            success:function(data){
                console.log(data);
                // $('select[name="layanan"]').empty();
                $.each(data, function(key, value){
                    $.each(value.costs, function(key1, value1){
                        $.each(value1.cost, function(key2, value2){
                            $('select[name="layanan"]').append('<option value="'+ key +'" harga_ongkir="'+value2.value+'" service="'+value1.service+'">' + value1.service + '-' + value1.description + '-' +value2.value+ '</option>');
                        });
                    });
                });
            }
        });
    } else {
        $('select[name="layanan"]').empty();
    }
});
$('select[name="layanan"]').on('change', function(){
        let totalbelanja = $("input[name=totalbelanja]").val();
        // membuat variable namakotaku untyk mendapatkan atribut nama kota
        var harga_ongkir = $("#layanan option:selected").attr("harga_ongkir");
        var service = $("#layanan option:selected").attr("service");
        // menampilkan hasil nama provinsi ke input id nama_provinsi
        $("#ongkoskirim").append(harga_ongkir);
        $("#service").val(service);
        var total_ongkir = $("#layanan option:selected").attr("harga_ongkir");
        $("#totalongkir").val(total_ongkir);
        let total = parseInt(totalbelanja) + parseInt(harga_ongkir);
        $("#total").append(total);
    });
</script>
