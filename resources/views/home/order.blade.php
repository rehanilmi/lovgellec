@include('home.css')
@include('home.header')

    <section class="ftco-section ftco-cart">
            <div class="container">
                @if(empty($headerorder) || count($headerorder) ==0 )
                <center><p>tidak ada product di order</p></center>
                @else
                <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th> Tanggal </th>
                                <th> Invoice</th>
                                <th> Total Belanja</th>
                                <th> Jumlah </th>
                                <th> Metode Pembayaran </th>
                                <th> Status Barang </th>
                                <th></th>
                                <th> Status Pembayaran </th>
                                <th> Pembayaran</th>
                                <th> Aksi </th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($headerorder as $headerorder)
                                <td> {{ $headerorder->tanggal_order }} </td>
                                <td> {{ $headerorder->id}} </td>
                                <td> {{ number_format($headerorder->total_belanja) }} </td>
                                <td> {{ $headerorder->count }} </td>
                                <td> {{ $headerorder->metode_pembayaran }} </td>
                                <td>  @if ($headerorder->status == 'Sedang Diproses') {{ $headerorder->status }}
                                      @elseif ($headerorder->status == 'Sudah Dikirim')
                                    <a href="{{ url('selesai',$headerorder->id) }}"
                                    onclick="return confirm('Apakah Produk Sudah Diterima?!')"
                                    class="btn btn-primary">Sudah Dikirim</a>
                                    @else
                                        {{ $headerorder->status }}
                                    @endif
                                <td>
                                <td><b>
                                        @if ($headerorder->payment_status == 1)
                                            Menunggu Pembayaran
                                        @elseif ($headerorder->payment_status == 2)
                                            Sudah Dibayar
                                        @elseif ($headerorder->payment_status == 3)
                                            COD
                                        @else
                                            Kadaluarsa
                                        @endif
                                    </b></td>

                                <td>
                                  @if ($headerorder->payment_status == 1)
                                  <a href="{{ url('payment', $headerorder->id) }}" class="btn btn-danger">Bayar Sekarang</a>
                                  @elseif ($headerorder->payment_status == 2)
                                  Pembayaran berhasil
                                  @elseif ($headerorder->payment_status == 3)
                                  COD
                                  @else
                                  Kadaluarsa
                                  @endif
                                </td>
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
      @endif
 </section>

@include('home.footer')
@include('home.script')
