<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartItems()
    {
        if (Auth::user()->cart) {

            $cart = Cart::where('user_id', Auth::user()->id)->first();
            $items = CartItem::where('cart_id', $cart->id)->get();

            if (count($items) > 0) {
                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();
                return response()->json([
                    'success' => true,
                    'subTotal' => $cart['subTotal'],
                    'total' => $cart['total'],
                    'items' => count($items),
                    'products' => CartResource::collection($items)
                ], 200);
            } else {
                return response()->json(['message' => 'Your cart is empty!'], 200);
            }
        } else {
            return response()->json(['message' => 'Your cart is empty!'], 200);
        }
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if ($product) {
            if (Auth::user()->cart) {

                $item['title'] = $product->title;
                $item['description'] = $product->description;
                $item['amount'] = $product->amount;
                $item['image'] = $product->image;
                $item['old_price'] = $product->old_price;
                $item['new_price'] = $product->new_price;
                $item['cart_id'] = Auth::user()->cart->id;

                CartItem::create($item);

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['message' => 'Item Added to your cart successfully'], 200);
            } else {

                $cart['user_id'] = Auth::user()->id;
                Cart::create($cart);

                $item['title'] = $product->title;
                $item['description'] = $product->description;
                $item['amount'] = $product->amount;
                $item['image'] = $product->image;
                $item['old_price'] = $product->old_price;
                $item['new_price'] = $product->new_price;
                $item['cart_id'] = Auth::user()->cart->id;

                CartItem::create($item);

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['message' => 'Item Added to your cart successfully'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such product'], 200);
        }
    }

    public function addQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item) {
            if ($item->carts->user->id == Auth::user()->id) {

                $item->old_price += $item->old_price / $item->quantity;
                $item->new_price += $item->new_price / $item->quantity;
                $item->quantity += 1;
                $item->save();

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['message' => 'quantity increased successfully'], 200);
            } else {
                return response()->json(['message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such item'], 200);
        }
    }

    public function rmQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item) {

            if ($item->carts->user->id == Auth::user()->id) {

                $item->old_price -= $item->old_price / $item->quantity;
                $item->new_price -= $item->new_price / $item->quantity;
                $item->quantity -= 1;
                $item->save();

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['message' => 'quantity decreased successfully'], 200);
            } else {
                return response()->json(['message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such item'], 200);
        }
    }

    public function removeItem($id)
    {
        $item = CartItem::find($id);
        if ($item) {
            if ($item->carts->user->id == Auth::user()->id) {
                $item->delete();

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['message' => 'item removed form cart successfully'], 200);
            } else {
                return response()->json(['message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such item'], 200);
        }
    }
}
