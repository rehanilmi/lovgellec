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

    public function user()
    {
       return $this->belongsTo(User::class);
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

            $total_delivered=HeaderOrder::where('status','=','Sedang Dikirim')->
            get()->count();
            $total_processing=HeaderOrder::where('status','=','Sedang Diproses')->
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
                $cart->price=$product->price;
                $cart->product_title=$product->title;
                $cart->image=$product->image;
                $cart->user_id=$user->id;
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
                return view('home.showcart', compact('cart'));
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
                          'gross_amount' => $val->total_belanja,
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


          public function payment_post(Request $request,$id)
               {
                   $json = json_decode($request->get('json'));
                   $order=HeaderOrder::find($id);
                   $order->snap_token=$request->transaction_status;
                   $order->save();
                   return view('home.order', compact('json','order'));
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
            $showcart = $this->show_cart();
            $totalCart =  cart::where('user_id','=',$userid)->count();
            $ldate = date('Y-m-d H:i:s');
            //
            foreach($data as $dt => $val)
            {
                $totalprice = $val->price * $val->quantity;
                $totalbelanja+= $totalprice;

            }

                $headerorder=new HeaderOrder;
                $headerorder->tanggal_order=$ldate;
                $headerorder->user_id=$userid;
                $headerorder->count=$totalCart;
                $headerorder->total_belanja=$request->totalbelanja;
                $headerorder->metode_pembayaran =$request->metode_pembayaran;
                $headerorder->status = 'Sedang Diproses';

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
                $order->user_id=$row->user_id;
                $order->product_id=$row->Product_id;
                $order->product_title=$row->product_title;
                $order->price=$row->price;
                $order->quantity=$row->quantity;
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
