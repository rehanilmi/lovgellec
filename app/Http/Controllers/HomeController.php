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
                $cart->quantity=$quantity + $request->quantity;
                $cart->price=$product->price;

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
                $cart->price=$product->price;
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



        public function payment($id)
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
                $data=HeaderOrder::where('user_id','=',$userid)->get();
                // $totalbelanja=0;


                foreach($data as $dt => $val)
                {
                    // $dd = ::where('header_order_id','=',$val->id)->get();

                    $params = array(
                        'transaction_details' => array(
                            'order_id' => rand(),
                            'gross_amount' => $val->total,
                        ),
                        'customer_details' => array(
                            'first_name' => 'sdr',
                            'last_name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                        ),
                    );
                }

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                return view('home.payment', compact ('snapToken'));
            }
        // public function payment_post(Request $request)
        // {
        //     $json = json_decode($request->get('json'));
        //     $order = new Order();
        //     $order->payment_status = $json->transaction_status;
        //     $order->name = $request->name;
        //     $order->email = $request->email;
        //     $order->phone = $request->phone;
        //     // $order->transaction_id = $json->transaction_id;
        //     // $order->order_id = $json->order_id;
        //     // $order->gross_amount = $json->gross_amount;
        //     // $order->payment_type = $json->payment_type;
        //     // $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        //     // $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        //     return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');
        // }



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



        //
        public function order()
        {
            if (Auth::id())
            {
                $user=Auth::user();
                $userid=$user->id;
                $headerorder=HeaderOrder::where('user_id','=',$userid)->get();
                return view('home.order', compact('headerorder'));
            }
            else
            {
                return redirect('login');
            }
        }
        //



        public function checkout(Request $request)
        {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $data=cart::where('user_id','=',$userid)->get();
            $totalbelanja=0;
            $provinsi = $this->get_province();
            $showcart = $this->show_cart();
            $totalCart =  cart::where('user_id','=',$userid)->count();
            $ldate = date('Y-m-d H:i:s');
            //
            foreach($data as $dt => $val)
            {
                $totalprice = $val->price * $val->quantity;
                $totalbelanja+= $totalprice;

                // $cart_id=$val->id;
                // $cart=cart::find($cart_id);
                // $cart->delete();

            }

                $headerorder=new HeaderOrder;
                $headerorder->tanggal_order=$ldate;
                $headerorder->user_id=$userid;
                $headerorder->count=$totalCart;
                $headerorder->total_belanja=$request->totalbelanja;
                $headerorder->total_ongkir=$request->totalongkir;
                $headerorder->total=$request->totalbelanja + $request->totalongkir;
                $headerorder->metode_pembayaran =$request->metode_pembayaran;
                $headerorder->kurir = $request->kurir;
                $headerorder->status = 'Sedang Diproses';
                $headerorder->layanan = $request->service;

                if($headerorder->metode_pembayaran == 'Transfer')
                {
                    $headerorder->payment_status = 1;
                    $headerorder->save();
                }
                elseif ($headerorder->metode_pembayaran == 'COD') {
                    $headerorder->payment_status = 3;
                    $headerorder->save();
                    // code...
                }
                else {
                    $headerorder->save();
                }


                $cart=cart::where('user_id','=',$userid)->get();

                foreach($cart as $row){

                $order=new order;
                $order->header_order_id=$headerorder->id;
                $order->name=$row->name;
                $order->email=$row->email;
                $order->phone=$row->phone;
                $order->address=$request->nama_provinsi;
                $order->user_id=$row->user_id;
                $order->product_title=$row->product_title;
                $order->price=$row->price;
                $order->quantity=$row->quantity;
                $order->image=$row->image;
                $order->product_id=$row->Product_id;
                $order->image=$row->image;
                $order->save();

                $cart_id=$row->id;
                $cart=cart::find($cart_id);
                $cart->delete();
                }

            return redirect(url('/order'))->with('alert-success', 'Order berhasil dibuat');

            }
            else
            {
            return redirect('login');
            }
        }



        public function detail_order($id)
        {
            $order=Order::where('header_order_id','=',$id)->get();
            return view('home.detail_order', compact('order',));
        }
}
