<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
Use App\Models\Wishlist;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;


class UserProfileController extends Controller
{
    public function account(){

        return view('Front.profile.account');
    }

    public function order(){
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('Front.profile.order',compact('orders'));
    }

    public function orderDetail($orderId){
        $order = Order::find($orderId);

        $orderItems = OrderItem::where('order_id', $orderId)->get();
        $orderCounts = OrderItem::where('order_id', $orderId)->count();

        
        return view('Front.profile.order-detail',compact('order', 'orderItems', 'orderCounts'));
    }

    public function wishlist(){

        $user = Auth::user();

        $wishlists = Wishlist::where("user_id", $user->id)->with('product')->get();



      
        
        return view('Front.profile.wishlist',compact('wishlists'));
    }

    public function changePassword(){
        
        return view('Front.profile.change-password');
    }


    public function cancelOrder(Request $request , $id){

        $order = Order::find($id);

        

       

        $order->delivery_status = 'cancelled';
        $order->save();

        $message = "Order Cancel  Successfully";

        $request->session()->flash('success',$message);

        return response()->json([
         'status' => true,
         'msg' => $message,
        ]);
    }


    public function DownloadPDF(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)->with('items')->first();
        $data['order'] = $order;

        $pdf = Pdf::loadView('pdf.order', $data)->setOptions(['defaultFont' => 'sans-serif']);;
        return $pdf->download('order.pdf');
    }

}
