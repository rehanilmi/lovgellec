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
                                <th> Tanggal </th>
                                <th> Invoice</th>
                                <th> Total Belanja</th>
                                <th> Total Ongkir</th>
                                <th> Total </th>
                                <th> Jumlah </th>
                                <th> Kurir </th>
                                <th> Layanan </th>
                                <th> Metode Pembayaran </th>
                                <th> Status Barang </th>
                                <th> Aksi </th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($headerorder as $headerorder)
                                <td> {{ $headerorder->tanggal_order }} </td>
                                <td> 783626543{{ $headerorder->id}} </td>
                                <td> {{ $headerorder->total_belanja }} </td>
                                <td> {{ $headerorder->total_ongkir }} </td>
                                <td> {{ $headerorder->total }} </td>
                                <td> {{ $headerorder->count }} </td>
                                <td> {{ $headerorder->kurir }} </td>
                                <td> {{ $headerorder->layanan }} </td>
                                <td> {{ $headerorder->metode_pembayaran }} </td>
                                <td> {{ $headerorder->status }} </td>

                                <td>
                                    <a href="{{ url('detail_order', $headerorder->id) }}" class="btn btn-info">Detail Order</a>
                                </td>

                            </tr><!-- END TR-->
                            @endforeach
                            <tr class="text-center">
                                <td class=""><a href="#"></a></td>
                                <td class="product-name"></td>
                                <td class="quantity">
                                    <div class="input-group mb-3"></div>
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
