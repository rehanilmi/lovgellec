<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\HeaderOrder;
use RealRashid\SweetAlert\Facades\Alert;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;
use Kavist\RajaOngkir\Facades\RajaOngkir;



class HomeController extends Controller
{


    public function index()
    {
        $product=Product::paginate(10);
        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status','=','delivered')->
            get()->count();
            $total_processing=order::where('delivery_status','=','processing')->
            get()->count();

            return view('admin.home', compact('total_product','total_order','total_user',
            'total_revenue','total_delivered','total_processing'));


        }
        else
        {
            $product=Product::paginate(10);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id)
    {
        $product=product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);
            $product_exist_id=cart::where('Product_id','=',$id)->where
            ('user_id','=',$userid)->get('id')->first();

            if($product_exist_id!=null)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $cart->quantity;

                    if($product->discount_price!=null)
                    {
                        $cart->price=$product->discount_price * $cart->quantity;
                    }
                    else
                    {
                        $cart->price=$product->price * $cart->quantity;
                    }

                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();

            }
            else
            {
                $cart=new cart;
                $cart->name=$user->name;
                $cart->email=$user->email;
                $cart->phone=$user->phone;
                $cart->address=$user->address;
                $cart->user_id=$user->id;

                $cart->product_title=$product->title;
                if($product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price=$product->price * $request->quantity;
                }

                $cart->image=$product->image;
                $cart->Product_id=$product->id;
                $cart->quantity=$request->quantity;

                $cart->save();
                return redirect()->back()->with('message','Product Added Successfully');
            }


        }
        else
        {
            return redirect('login');
        }

    }
    public function show_cart()
        {
            if(Auth::id())
            {
                $id=Auth::user()->id;
                $cart=cart::where('user_id','=',$id)->get();
                $provinsi = $this->get_province();

                return view('home.showcart', compact('cart','provinsi'));
            }
            else
            {
                return redirect('login');
            }

        }

        public function remove_cart($id)
        {
            $cart=cart::find($id);
            $cart->delete();
            return redirect()->back();
        }

        public function cash_order()
        {
            $user=Auth::user();
            $userid=$user->id;
            $data=cart::where('user_id','=',$userid)->get();

            foreach($data as $data)
            {
                $order=new order;

                $order->name=$data->name;
                $order->email=$data->email;
                $order->phone=$data->phone;
                $order->address=$data->address;
                $order->user_id=$data->user_id;
                $order->product_title=$data->product_title;
                $order->price=$data->price;
                $order->quantity=$data->quantity;
                $order->image=$data->image;
                $order->product_id=$data->Product_id;

                $order->payment_status='COD';
                $order->delivery_status='Sedang dalam proses';
                $order->save();

                $cart_id=$data->id;
                $cart=cart::find($cart_id);
                $cart->delete();
            }
            return redirect()->back()->with('message','We have received your order. We will connect with you soon..');
        }

        public function payment(Request $request)
        {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = "SB-Mid-server-WkAHMa1WfB8zECN5nFR3jrOz";
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $user=Auth::user();
            $userid=$user->id;
            $data=cart::where('user_id','=',$userid)->get();
            $totalbelanja=0;


            foreach($data as $dt => $val)
            {
              $totalprice = $val->price * $val->quantity;
              $totalbelanja+= $totalprice;

              $params = [
                          'transaction_details' => array(
                              'order_id' => rand(),
                              'gross_amount' => 10000,
                          ),
                          'item_details' => array(
                              [
                                  'id' => $val->id,
                                  'price' => $totalbelanja,
                                  'quantity' => $val->quantity,
                                  'name' => $val->product_title
                              ],
                            ),

                          'customer_details' => array(
                              'first_name' => 'sdr',
                              'last_name' => $val->name,
                              'email' => $val->email,
                              'phone' => $val->phone,
                            ),
                          ];

                      $order=new order;

                      $order->name=$val->name;
                      $order->email=$val->email;
                      $order->phone=$val->phone;
                      $order->address=$val->address;
                      $order->user_id=$val->user_id;
                      $order->product_title=$val->product_title;
                      $order->price=$val->price;
                      $order->quantity=$val->quantity;
                      $order->image=$val->image;
                      $order->product_id=$val->Product_id;

                      $order->payment_status='transfer';
                      // $order->delivery_status='Sedang dalam proses';
                      $order->save();

                      $cart_id=$val->id;
                      $cart=cart::find($cart_id);
                      $cart->delete();

                }

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('home.payment', compact ('snapToken'));
        }

        public function payment_post(Request $request)
        {
               $json = json_decode($request->get('json'));
               $order = new Order();
               $order->payment_status = $json->transaction_status;
               $order->name = $request->name;
               $order->email = $request->email;
               $order->phone = $request->phone;
               // $order->transaction_id = $json->transaction_id;
               // $order->order_id = $json->order_id;
               // $order->gross_amount = $json->gross_amount;
               // $order->payment_type = $json->payment_type;
               // $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
               // $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
               return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');
           }

        // public function kurir()
        // {
        //        $provinces = Province::pluck('name', 'province_id');
        //        return view('home.ongkir', compact('provinces'));
        //    }
        //
        //    public function getCities($id)
        //    {
        //        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        //        return response()->json($city);
        //    }
        //
        //    public function check_ongkir(Request $request)
        //    {
        //        $cost = RajaOngkir::ongkosKirim([
        //            'origin'        => 345, // ID kota/kabupaten asal
        //            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
        //            'weight'        => 1000, // berat barang dalam gram
        //            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        //        ])->get();
        //
        //        return response()->json($cost);
        //
        //        // $nama_jasa = $cost[0]['name'];
        //        //      foreach ($cost[0]['costs'] as $row)
        //        //      {
        //        //      	$result[] = array(
        //        //      		'description' => $row['description'],
        //        //      		'biaya'       => $row['cost'][0]['value'],
        //        //      		'etd'         => $row['cost'][0]['etd']
        //        //      	);
        //        //      }
        //
        //    }

        public function get_province(){
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: b7f0f0d4a7e7344f9a861958e4fd4c8b"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
          echo "cURL Error #:" . $err;
          } else {
          //ini kita decode data nya terlebih dahulu
          $response=json_decode($response,true);
          //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
          $data_pengirim = $response['rajaongkir']['results'];
          return $data_pengirim;
          }

        }

        public function get_city($id){
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: b7f0f0d4a7e7344f9a861958e4fd4c8b"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
          echo "cURL Error #:" . $err;
          } else {
          $response=json_decode($response,true);
          $data_kota = $response['rajaongkir']['results'];
          return json_encode($data_kota);
          }

        }

        public function get_ongkir($origin, $destination, $weight, $courier){
        $curl = curl_init();
        $origin = 456;
        $weight = 1000;
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
        CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: b7f0f0d4a7e7344f9a861958e4fd4c8b"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        $response=json_decode($response,true);
        $data_ongkir = $response['rajaongkir']['results'];
        return json_encode($data_ongkir);
        }
        }

        public function show_order()
        {
            if (Auth::id())
            {
                $user=Auth::user();
                $userid=$user->id;
                $order=order::where('user_id','=',$userid)->get();
                return view('home.order', compact('order'));
            }
            else
            {
                return redirect('login');
            }
        }

        public function cancel_order($id)
        {
            $order=order::find($id);
            $order->delivery_status='Pesanan dibatalkan';
            $order->save();
            return redirect()->back();
        }

        public function product_search(Request $request)
        {
            $search_text=$request->search;
            $product=product::where('title','LIKE','%$search_text%')->orWhere('category','LIKE',
            "%$search_text%")->paginate(10);
            return view('home.userpage', compact('product'));
        }

        public function product()
        {
            $product=Product::paginate(10);
            return view('home.all_product', compact ('product'));
        }

        public function search_product(Request $request)
        {
            $search_text=$request->search;
            $product=product::where('title','LIKE','%$search_text%')->orWhere('category','LIKE',
            "%$search_text%")->paginate(10);
            return view('home.all_product', compact('product'));
        }

        public function contact()
        {
            return view('home.contact');
        }

        public function do_create_order(){

        }

}
