<?php

use App\Mail\OrderEmail;
use App\Models\Country;
use App\Models\Order;
use App\Models\productimage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

function ProductImage($id){

    return productimage::where('product_id',$id)->first();
}
function country($id){
    return Country::find($id);;
}

function OrderEmail($orderId,$userType = 'customer'){

    $order = Order::where('id',$orderId)->with('items')->first();

    if($userType == 'customer'){
       $subject = 'Thank For Your Order';
       $email = $order->email;
    }
    else{

        $admin = User::where('role',1)->first();
        $subject = 'You have Recived an Order';
        $email = $admin->email;
    }


    $maildata = [
        'subject' => $subject,
        'order' => $order,
    ];

    Mail::to($email)->send( new OrderEmail($maildata));

    
}
?>


