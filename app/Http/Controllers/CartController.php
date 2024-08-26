<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CustomerDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use App\Models\Accessorie;
use App\Models\ShippingCharge;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function AddtoCart(Request $request)
    {

        $product = product::with('image')->find($request->id);
        $accessories = Accessorie::find($request->id);
        $status = $request->status;

        

        if ($status == "plants") {
            if ($product == null) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Product Not Found',
                ]);
            }
            if (Cart::count() > 0) {
                $Cart = Cart::content();
                $productAlreadyExist = false;
                foreach ($Cart as $item) {
                    if ($item->id == $product->id) {
                        $productAlreadyExist = true;
                    }
                }
                if ($productAlreadyExist == false) {
                    Cart::add($product->id, $product->title, 1, $product->price, ["productImage" => (!empty($product->image->first())) ? $product->image->first() : '']);
                    $status = true;
                    $message = $product->title . ' Added in Cart';
                } else {
                    $status = false;
                    $message = $product->title . ' Already Added in Cart';
                }
            } else {
                Cart::add($product->id, $product->title, 1, $product->price, ["productImage" => (!empty($product->image->first())) ? $product->image->first() : '']);
                $status = true;
                $message = $product->title . ' Added in Cart';

            }
        } else if ($status == "accessories") {
            if ($accessories == null) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Accessories Not Found',
                ]);
            }
            if (Cart::count() > 0) {
                $Cart = Cart::content();
                $productAlreadyExist = false;
                foreach ($Cart as $item) {
                    if ($item->id == $accessories->id) {
                        $productAlreadyExist = true;
                    }
                }
                if ($productAlreadyExist == false) {
                    Cart::add($accessories->id, $accessories->title, 1, $accessories->price);
                    $status = true;
                    $message = $accessories->title . ' Added in Cart';
                } else {
                    $status = false;
                    $message = $accessories->title . ' Already Added in Cart';
                }
            } else {
                Cart::add($accessories->id, $accessories->title, 1, $accessories->price);
                $status = true;
                $message = $accessories->title . ' Added in Cart';
            }
        }

        return response()->json([
            'status' => $status,
            'msg' => $message,
        ]);
    }

    // public function UpdateCart(Request $request)
    // {

    //     $rowId = $request->rowid;
    //     $qty = $request->qty;
    //     $id = Cart::get($rowId);
    //     $product = product::find($id->id);
    //     if ($request->qty <= $product->qty) {
    //         Cart::update($rowId, $qty);
    //         $status = true;
    //         $message = '<strong>' . $product->title . '</strong> Updated Successfully';

    //         $request->session()->flash("success", $message);
    //     } else {
    //         $status = false;
    //         $message = 'Requested Quantity(' . $qty . ') is not avialable';
    //         $request->session()->flash("error", $message);

    //     }
    //     return response()->json([
    //         'status' => $status,
    //         'msg' => $message,
    //     ]);
    // }
    public function UpdateCart(Request $request)
{
    $rowId = $request->rowid;
    $qty = $request->qty;
    $item = Cart::get($rowId);

    // Check if the item exists in the cart
    if (!$item) {
        return response()->json([
            'status' => false,
            'msg' => 'Item Not Found in Cart',
        ]);
    }

    $productType = $item->options->productType;

    if ($productType == 'plants') {
        $product = Product::find($item->id);
        if ($product && $qty <= $product->qty) {
            Cart::update($rowId, $qty);
            $status = true;
            $message = '<strong>' . $product->title . '</strong> Updated Successfully';
        } else {
            $status = false;
            $message = 'Requested Quantity (' . $qty . ') is not available';
        }
    } else if ($productType == 'accessories') {
        $accessory = Accessorie::find($item->id);
        if ($accessory && $qty <= $accessory->qty) {
            Cart::update($rowId, $qty);
            $status = true;
            $message = '<strong>' . $accessory->title . '</strong> Updated Successfully';
        } else {
            $status = false;
            $message = 'Requested Quantity (' . $qty . ') is not available';
        }
    } else {
        $status = false;
        $message = 'Unknown Product Type';
    }

    // Flash message to the session (if applicable)
    $request->session()->flash($status ? 'success' : 'error', $message);

    return response()->json([
        'status' => $status,
        'msg' => $message,
    ]);
}

    public function DeleteCart(Request $request)
    {
        $rowId = $request->rowid;
        Cart::remove($rowId);
        $status = true;
        $message = '<strong>Product</strong> Remove Cart in   Successfully';

        $request->session()->flash("success", $message);

        return response()->json([
            'status' => $status,
            'msg' => $message,
        ]);

    }

    public function proceed(Request $request)
    {

        // 1 step Apply  Validation

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:15',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'msg' => 'Please Fix The Error',
                'errors' => $validator->errors(),
            ]);
        }

        // 2 step Save Data  Customer Detail Table

        $user = Auth::user();

        CustomerDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'mobile' => $request->mobile,

            ]

        );

        // 3 step Save orders Data

        $shipping = 0;
        $discount = 0;
        $subtotal = Cart::subtotal(2, '.', '');
        $grandTotal = $subtotal + $shipping;
        $promoCode = '';
        $promoCodeId = null;

        // calculate discount here

        if (session()->has('code')) {

            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subtotal;
            } else {
                $discount = $code->discount_amount;
            }
            $promoCode = $code->code;
            $promoCodeId = $code->id;

        }
        // Calulate Shipping Here

        $shipping = ShippingCharge::where('country_id', $request->country)->first();

        $total = 0;

        foreach (Cart::content() as $item) {

            $total += $item->qty;
        }

        if ($shipping != null) {

            $shipping = $shipping->amount * $total;

            $grandTotal = ($subtotal - $discount) + $shipping;

        } else {

            $shipping = ShippingCharge::where('country_id', 'rest_of_world')->first();
            $shipping = $shipping->amount * $total;
            $grandTotal = ($subtotal - $discount) + $shipping;

        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->subtotal = $subtotal;
        $order->shipping = $shipping;
        $order->discount = $discount;
        $order->grand_total = $grandTotal;
        $order->coupon_code = $promoCode;
        $order->coupon_code_id = $promoCodeId;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->country_id = $request->country;
        $order->address = $request->address;
        $order->apartment = $request->apartment;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->mobile = $request->mobile;
        $order->notes = $request->order_notes;
        $order->save();

        // 4 step Save order Items Data

        foreach (Cart::content() as $item) {
            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->product_id = $item->id;
            $orderitem->name = $item->name;
            $orderitem->qty = $item->qty;
            $orderitem->price = $item->price;
            $orderitem->total = $item->price * $item->qty;
            $orderitem->save();

            $product = product::find($item->id);
            $currentqty = $product->qty;
            $updatedqty = $product->qty - $item->qty;
            $product->qty = $updatedqty;
            $product->save();
        }

        OrderEmail($order->id, 'customer');

        Cart::destroy();

        session()->forget('code');

        return response()->json([
            'status' => true,
            'msg' => 'Order placed Successfully',
            'orderId' => $order->id,
        ]);
    }

    public function getOrderSummary(Request $request)
    {

        $subtotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $discontString = '';

        // Calulate discount here

        if (session()->has('code')) {

            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subtotal;
            } else {
                $discount = $code->discount_amount;
            }

            $discontString = ' <div class="mt-4 discount-code">
                            <strong>' . session()->get('code')->code . '</strong>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="removeCoupon()">X</a>
                        </div>';
        }

        // Calculate Shipping Here

        if ($request->country_id > 0) {

            $countryID = $request->country_id;
            $shipping = ShippingCharge::where('country_id', $countryID)->first();

            $total = 0;

            foreach (Cart::content() as $item) {

                $total += $item->qty;
            }

            if ($shipping != null) {

                $shippingCharges = $shipping->amount * $total;

                $grandTotal = ($subtotal - $discount) + $shippingCharges;

                return response()->json([

                    'status' => true,
                    'ShippingCharges' => number_format($shippingCharges, 2),
                    'discount' => number_format($discount, 2),
                    'GrandTotal' => number_format($grandTotal, 2),
                    'discountString' => $discontString,
                ]);
            } else {

                $shipping = ShippingCharge::where('country_id', 'rest_of_world')->first();

                $shippingCharges = $shipping->amount * $total;

                $grandTotal = ($subtotal - $discount) + $shippingCharges;

                return response()->json([

                    'status' => true,
                    'ShippingCharges' => number_format($shippingCharges, 2),
                    'discount' => number_format($discount, 2),
                    'GrandTotal' => number_format($grandTotal, 2),
                ]);
            }

        } else {
            return response()->json([
                'status' => true,
                'ShippingCharges' => number_format(0, 2),
                'discount' => number_format($discount, 2),
                'GrandTotal' => number_format($subtotal - $discount, 2),
            ]);

        }

    }

    public function GetDiscountSummary(Request $request)
    {

        $code = $request->code;
        $now = Carbon::now();

        $coupon = Coupon::where('code', $code)->first();

        if ($coupon == null) {

            return response()->json([
                'status' => false,
                'msg' => 'invalid discount coupon',
            ]);
        }

        if ($coupon->start_at != '') {

            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->start_at);

            if ($now->lt($startAt)) {

                return response()->json([
                    'status' => false,
                    'msg' => 'invalid discount coupon',
                ]);
            }
        }

        if ($coupon->expire_at != '') {

            $ExpireAt = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->expire_at);

            if ($now->gt($ExpireAt)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'invalid discount coupon',
                ]);
            }
        }

        if ($coupon->max_uses > 0) {

            $maxUses = Order::where('coupon_code_id', $coupon->id)->count();

            if ($maxUses > $coupon->max_uses) {
                return response()->json([
                    'status' => false,
                    'msg' => 'invalid discount coupon ',
                ]);
            }
        }

        if ($coupon->max_user_uses > 0) {

            $maxUserUses = Order::where(['coupon_code_id' => $coupon->id, 'user_id' => Auth::user()->id])->count();

            if ($maxUserUses > $coupon->max_user_uses) {
                return response()->json([
                    'status' => false,
                    'msg' => 'You Already use this coupon code',
                ]);
            }
        }

        if ($coupon->min_amount > 0) {
            $subtotal = Cart::subtotal(2, '.', '');

            if ($subtotal < $coupon->min_amount) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Your minimum amount must be <strong>$' . $coupon->min_amount . '</strong>',
                ]);
            }
        }

        session()->put('code', $coupon);
        return $this->getOrderSummary($request);

    }

    public function RemoveCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }
}
