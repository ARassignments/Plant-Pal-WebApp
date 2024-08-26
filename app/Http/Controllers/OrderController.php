<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function ChangrStatus(Request $request , $id){


        $order = Order::find($id);

       

        $order->delivery_status = $request->status;
        $order->shipping_date = $request->shipping_date;
        $order->save();

        $message = "Order Status Changed Successfully";

        $request->session()->flash('success',$message);

        return response()->json([
         'status' => true,
         'msg' => $message,
        ]);
    }

    public function SendInvioceEmail(Request $request, $id)
    {

        OrderEmail($id,$request->userType);


        $message = "Order Email Sent Successfully";
        
        $request->session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'msg' => $message,
        ]);
    }
}
