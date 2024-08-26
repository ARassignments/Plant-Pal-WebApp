<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\contact;
use App\Models\Coupon;
use App\Models\news;
use App\Models\Order;
use App\Models\Accessorie;
use App\Models\OrderItem;
use App\Models\tempimage;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{

    public function dashboard()
    {

        $orders = Order::where('delivery_status', '!=', "cancelled")->count();
        $products = product::count();
        $users = User::where('role', 0)->count();

        // Total Revenue 

        $totalReveneu =  Order::where('delivery_status', '!=', "cancelled")->sum('grand_total');


        // Reveneu This month 

        $currentdate = Carbon::now()->format('Y-m-d');
        $thismonthstartDate = Carbon::now()->startOfMonth()->format('Y-m-d');


        $Reveneuthismonth = Order::where('delivery_status', '!=', "cancelled")
            ->whereDate('created_at', '>=', $thismonthstartDate)
            ->whereDate('created_at', '<=', $currentdate)
            ->sum('grand_total');

        // Reveneu last month

        $lastmonthstartdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastmonthenddate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastmonth = Carbon::now()->subMonth()->endOfMonth()->format('M');

        $Reveneulastmonth = Order::where('delivery_status', '!=', "cancelled")
            ->whereDate('created_at', '>=', $lastmonthstartdate)
            ->whereDate('created_at', '<=', $lastmonthenddate)
            ->sum('grand_total');



        // Reveneu last 30 days 

        $lastthirtydaysdate = Carbon::now()->subDay(30)->format('Y-m-d');

        $ReveneulastThirtyDays = Order::where('delivery_status', '!=', "cancelled")
            ->whereDate('created_at', '>=', $lastthirtydaysdate)
            ->whereDate('created_at', '<=', $currentdate)
            ->sum('grand_total');


        // Delete Temp images here

        $lastBeforeDate = Carbon::now()->subDay(1)->format('Y-m-d H:i:s');
        $tempImages = tempimage::where('created_at', '<=', $lastBeforeDate)->get();

        foreach ($tempImages as $tempImage) {

            $path = public_path('/temp/' . $tempImage->image);
            $Thumbpath = public_path('/temp/thumb/' . $tempImage->image);




            if (File::exists($path)) {
                File::delete($path);
            }

            // Thmb Images Delete Here

            if (File::exists($Thumbpath)) {
                File::delete($Thumbpath);
            }
            tempimage::where('id', $tempImage->id)->delete();
        }


        return view("Admin.dashboard", compact(
            'orders',
            'products',
            'users',
            'totalReveneu',
            'Reveneuthismonth',
            'Reveneulastmonth',
            'lastmonth',
            'ReveneulastThirtyDays'

        ));
    }


    public function category(Request $request)
    {

        $categories = Category::query();
        if (!empty($request->keyword)) {
            $categories->where('name', 'like', '%' . $request->keyword . '%');
        }
        $sortBy = $request->input('sort_by', 'name'); 
        $sortOrder = $request->input('sort_order', 'asc'); 
    
            if (in_array($sortBy, ['name'])) {
            $categories->orderBy($sortBy, $sortOrder);
        } else {
            $categories->orderBy('id', 'asc'); // Default sorting
        }
        $categories = $categories->paginate(10);
        return view("Admin.category.category", compact('categories'));
    }





    public function acccessoire(Request $request)
    {
        $Accessorie = Accessorie::query();
      
        if (!empty($request->keyword)) {
            $Accessorie->where('title', 'like', '%' . $request->keyword . '%');
        }
        $sortBy = $request->input('sort_by', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc'); 
    
        if (in_array($sortBy, ['title', 'price', 'qty'])) {
            $Accessorie->orderBy($sortBy, $sortOrder);
        } else {
            $Accessorie->orderBy('id', 'asc'); 
        }
        $Accessorie = $Accessorie->paginate(10);
        return view("Admin.accessories.accessories", compact('Accessorie'));
    }


    public function product(Request $request)
    {
        $products = product::with('image');
        if (!empty($request->keyword)) {
            $products->where('title', 'like', '%' . $request->keyword . '%');
        }
        $sortBy = $request->input('sort_by', 'title'); // Default to 'title'
        $sortOrder = $request->input('sort_order', 'asc'); // Default to 'asc'

        // Apply sorting
        if (in_array($sortBy, ['title', 'price'])) {
            $products->orderBy($sortBy, $sortOrder);
        } else {
            $products->orderBy('title', 'asc'); // Default sorting by 'title'
        }
        $products = $products->paginate(15);
        return view("Admin.product.product", compact('products'));
    }


    public function order(Request $request)
    {


        $orders = Order::latest('orders.created_at')->select('orders.*', 'users.name', 'users.email')->leftJoin('users', 'users.id', '=', 'orders.user_id');
        if (!empty($request->keyword)) {
            $orders->where('users.name', 'like', '%' . $request->keyword . '%');
            $orders->orWhere('users.email', 'like', '%' . $request->keyword . '%');
            $orders->orWhere('orders.id', 'like', '%' . $request->keyword . '%');
            $orders->orWhere('orders.id', 'like', '%' . $request->keyword . '%');
            $orders->orWhere('orders.delivery_status', 'like', '%' . $request->keyword . '%');
        }



        $orders = $orders->paginate(8);


        return view("Admin.order.order", compact('orders'));
    }

    public function OrderDetail(Request $request, $id)
    {

        $order = Order::find($id);
        $items = OrderItem::where('order_id', $id)->get();

        return view('Admin.order.order-detail', compact('order', 'items'));
    }

    public function discount(Request $request)
    {

        $coupons = Coupon::latest();
        if (!empty($request->keyword)) {
            $coupons->where('title', 'like', '%' . $request->keyword . '%');
        }
        $coupons = $coupons->paginate(8);

        return view("Admin.discount.discount", compact('coupons'));
    }

    public function user(Request $request)
    {

        $users = User::where('role', 0)->latest('users.created_at')->select('users.*', 'customer_details.mobile', 'customer_details.country_id')
            ->leftJoin('customer_details', 'users.id', '=', 'customer_details.user_id');

        if (!empty($request->keyword)) {
            $users = $users->where('users.name', 'like', '%' . $request->keyword . '%');
            $users = $users->orWhere('users.email', 'like', '%' . $request->keyword . '%');


        }



        $users = $users->paginate(8);

        return view("Admin.user", compact('users'));
    }


    public function DeleteUser(Request $request, $id)

    {
        $user = User::where('role', 0)->where('id', $id)->first();
        if (empty($user)) {

            $request->session()->flash('error', 'User Not Found');

            return response()->json([
                'status' => true,
                'msg' => 'User Not Found'
            ]);
        }

        $user->delete();

        $request->session()->flash('success', 'User Deleted Successfully');

        return response()->json([
            'status' => true,
            'msg' => 'User Deleted Successfully'
        ]);
    }

    public function contact(Request $request)
    {
        $contacts = contact::latest();
        if (!empty($request->keyword)) {
            $contacts->where('name', 'like', '%' . $request->keyword . '%');
        }
        $contacts = $contacts->paginate(8);
        return view('Admin.contactus.contact',compact('contacts'));
    }


    public function feedback(Request $request)
    {
        $feedbacks = Feedback::latest();
        if (!empty($request->keyword)) {
            $feedbacks->where('name', 'like', '%' . $request->keyword . '%');
        }
        $feedbacks = $feedbacks->paginate(8);
        return view('Admin.feedback.feedback',compact('feedbacks'));
    }

    public function Wishlist(Request $request)
    {
       
        $wishlists = Wishlist::with('product', 'user')
        ->leftJoin('products', 'wishlists.product_id', '=', 'products.id')
        ->leftJoin('users', 'wishlists.user_id', '=', 'users.id')
        ->select('wishlists.*', 'products.title as product_name', 'users.name as user_name');
        
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $wishlists->where(function($query) use ($keyword) {
                $query->where('products.title', 'like', '%' . $keyword . '%')
                    ->orWhere('users.name', 'like', '%' . $keyword . '%');
            });
        }
        if (!empty($request->sort_by)) {
            $sortBy = $request->sort_by;
            if (in_array($sortBy, ['product_name', 'user_name'])) {
                $wishlists->orderBy($sortBy, $request->sort_order ?? 'asc');
            }
        }
        $wishlists = $wishlists->paginate(8);
        return view('Admin.wishlists.wishlist',compact('wishlists'));
    }


    public function contactdestroy(Request $request , string $id)
    {
        $contact = contact::find($id);

       if(empty($contact)){

        $error = "Contact Not Found";

        $request->session()->flash('error',$error);
          
        return response()->json([
        'status' => false,
        'msg' => $error,
        ]);

       }

       $contact->delete();



       $status = true;
        $message = "contact Delete Successfully";

       $request->session()->flash('success',$message);



     return response()->json([
        'status' => $status,
        'msg' => $message
     ]);
    }
public function feedbackdestroy(Request $request , string $id)
    {
        $Feedback = Feedback::find($id);

       if(empty($Feedback)){

        $error = "Feedback Not Found";

        $request->session()->flash('error',$error);
          
        return response()->json([
        'status' => false,
        'msg' => $error,
        ]);

       }

       $Feedback->delete();



       $status = true;
        $message = "Feedback Delete Successfully";

       $request->session()->flash('success',$message);



     return response()->json([
        'status' => $status,
        'msg' => $message
     ]);
    }

}
