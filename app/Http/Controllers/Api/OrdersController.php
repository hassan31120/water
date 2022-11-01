<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetailsResource;
use App\Http\Resources\OrdersResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function confirm_order(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'pay_status' => 'required'
        ]);
        $data = $request->all();
        $addresses = Auth::user()->addresses;
        for ($i = 0; $i < count($addresses); $i++) {
            $ad[] = $addresses[$i]->id;
        }
        if (in_array($data['address_id'], $ad)) {
            if (Auth::user()->cart->total > 0 && Auth::user()->cart->subTotal > 0) {

                $data['user_id'] = Auth::user()->id;
                $data['cart_id'] = Auth::user()->cart->id;
                Order::create($data);

                foreach (Auth::user()->cart->cartItems as $item) {
                    $detail['title'] = $item->title;
                    $detail['image'] = $item->image;
                    $detail['old_price'] = $item->old_price;
                    $detail['new_price'] = $item->new_price;
                    $detail['quantity'] = $item->quantity;
                    $detail['order_id'] = Auth::user()->orders[count(Auth::user()->orders) - 1]->id;
                    OrderDetail::create($detail);
                }

                $order = Order::where('id', Auth::user()->orders[count(Auth::user()->orders) - 1]->id)->first();
                $order->subTotal = Auth::user()->cart->subTotal;
                $order->total = Auth::user()->cart->total;
                $exp = $order->address->cities->price;
                if ($exp > 0) {
                    $order->grandTotal = $exp + $order->total;
                }else{
                    $order->grandTotal = null;
                }
                $order->save();
                $cart = Cart::where('user_id', Auth::user()->id)->first();
                CartItem::where('cart_id', $cart->id)->delete();
                $cart['subTotal'] = null;
                $cart['total'] = null;
                $cart['grandTotal'] = null;
                $cart->save();

                return response()->json([
                    'success' => true,
                    'message' => 'your order is placed successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'this address doesn\'t belong to you'
            ], 200);
        }
    }

    public function order_details($id)
    {
        $order = Order::find($id);
        $exp =(double) $order->address->cities->price;
        $details = OrderDetail::where('order_id', $id)->get();
        return response()->json([
            'success' => true,
            'total' => $order->total,
            'shipping_expenses' => $exp,
            'grand_total' => $order->grandTotal,
            'order' => DetailsResource::collection($details)
        ], 200);

    }

    public function user_orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        if (count($orders) > 0) {
            return response()->json([
                'success' => true,
                'order' => OrdersResource::collection($orders)
            ], 200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'you don\'t have any orders'
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
