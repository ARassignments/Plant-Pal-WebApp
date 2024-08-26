<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Rating;
use App\Models\accessorie;
use App\Models\User;
use App\Models\Category;
use App\Models\contact;
use App\Models\ShippingCharge;
use App\Models\Country;
use App\Models\Feedback;
Use Illuminate\Support\Facades\Auth;
Use App\Models\Coupon;
use App\Models\CustomerDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

use Illuminate\Support\Facades\Validator;

use Gloudemans\Shoppingcart\Facades\Cart;



class FrontController extends Controller
{
    public function index(){


        $products = Product::where('status', 1)->where("is_featured", "Yes")->get();
        $accessorie = accessorie::where('status', 1)->get();
        return view('Front.index',compact('products','accessorie'));
    }

    public function about(){

        return view('Front.about');
    }

    public function service(){
        $accessorie = accessorie::where('status', 1)->get();

        return view('Front.service',compact('accessorie'));
    }

    public function contact(){

        return view('Front.contact');
    }

    public function shop(Request $request, $categorySlug = null){

        $categories = Category::where('status', 1)->get();
        $categoryID = '';

        $products = Product::where('status', 1);
        $productsCount = Product::where('status', 1)->count();



        // category filter
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $categoryID = $category->id;
            if ($category) {
                $products->where('category_id', $category->id);
            }
        }


    
        // price filter

        if ($request->get('price_min') != "" && $request->get('price_max') != "") {
            if ($request->get('price_max') == 10000) {
                $products->whereBetween('price', [intval($request->get('price_min')), 1000000]);
            } else {
                $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
            }
        }

        // Sort filter
        if ($request->get('sort')) {
            if ($request->get('sort') == "latest") {
                $products->orderBy('id', 'DESC');
            } else if ($request->get('sort') == "price_desc") {
                $products->orderBy('price', 'DESC');
            } else {
                $products->orderBy('price', 'ASC');
            }
        }

        // Fetch the results
        $products = $products->get();

        $sort = $request->get('sort');
        $pricemax = (intval($request->get('price_max')) == 0) ? 10000 : intval($request->get('price_max'));
        $pricemin = intval($request->get('price_min'));
     
 

        return view('Front.shop',compact('categories', 'sort', 'products', 'categoryID', 'pricemin', 'pricemax','productsCount'));
    }

    public function cart(){
        $cartItems = Cart::content();
        
        return view('Front.cart',compact("cartItems"));
    }

    public function checkout(){

        if (Cart::count() == 0) {
            return redirect()->route('Cart');
        }

        if (Auth::check() == false) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('login');
        }

        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();

        $Customers = CustomerDetail::where('user_id', Auth::user()->id)->first();

        $total = 0;
        $discount = 0;
        $subtotal = Cart::subtotal(2, '.', '');
        $shippingcharges = 0;
        $grandtotal = $subtotal;
        // Calulate discount here

        if (session()->has('code')) {

            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subtotal;
            } else {
                $discount = $code->discount_amount;
            }
        }

        if (!empty($Customers)) {
            $shippinginfo = ShippingCharge::where('country_id', $Customers->country_id)->first();
            foreach (Cart::content() as $item) {
                $total += $item->qty;
            }

            if ($shippinginfo != null) {

                $shippingcharges = $shippinginfo->amount * $total;
                $grandtotal = ($subtotal - $discount)  + $shippingcharges;
            } else {

                $shipping = ShippingCharge::where('country_id', 'rest_of_world')->first();
                $shippingcharges = $shipping->amount * $total;
                $grandtotal = ($subtotal - $discount)  + $shippingcharges;
            }
        }

       

        
       
        return view('Front.checkout', compact('countries', 'Customers', 'shippingcharges', 'grandtotal', 'discount'));
    }

    public function error(){

        return view('Front.404');
    }

    public function productDetail(Request $request , $slug){


        $product = Product::where('slug', $slug)->first();

        if (empty($product)) {

            return redirect()->route('Front.error');
        }

        $relatedProducts = [];

        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);

            $relatedProducts = product::whereIn('id', $productArray)->get();
        }

        // Rating  Here

        $ratings = Rating::where(['product_id' => $product->id, 'status' => 1])->get();

  

        return view('Front.product-detail',compact("product", "relatedProducts", "ratings"));
    }
    public function accessorieDetail(Request $request , $slug){


        $accessories = Accessorie::where('slug', $slug)->first();

        if (empty($accessories)) {

            return redirect()->back();
        }

        $relatedProducts = [];  

        return view('Front.product-detail',compact("accessories"));
    }


    public function SendContactEmal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        if ($validator->passes()) {


            $contact = new contact();
            $contact->name = $request->name;
            $contact->email =$request->email;
            $contact->subject = $request->subject;
            $contact->message =  $request->message;
            $contact-> save();

            $maildata = [
                'name' => $request->name,
                'subject' => $request->subject,
                'email' => $request->email,
                'message' => $request->message,
                'subjects' => 'You have a Contant Email'
            ];

            $admin = User::where('role', 1)->first();

            Mail::to($admin->email)->send(new ContactEmail($maildata));

            $request->session()->flash('success', 'Your Message Send Succesfully');
            return response()->json([
                'status' => true,
                'msg' => 'Your Message Send Succesfully',

            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Please Fix the Errors',
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function StoreFeedback(Request $request ){
        if(Auth::check() == false){

            return redirect()->route('login');
        }
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
           'name' => 'required|min:3',
           'email' => 'required|email',
           'message' => 'required|min:10'
        ]);


        if($validator->passes()){

          

          

            $feedback = new Feedback();
            $feedback->user_id = $user->id; 
            $feedback->name = $request->name; 
            $feedback->email = $request->email; 
            $feedback->message = $request->message; 
            $feedback->save();

            $message = 'Your Feedback Send Successfully';
            $request->session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'msg' => $message,
            ]);

        }
        else{

            return response()->json([
             'status' => false,
             'errors' => $validator->errors(),
            ]);
        }
    }
    public function gallery()
    {
        return view('Front.gallery');
    }
}