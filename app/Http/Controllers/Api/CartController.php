<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Masajed;
use App\Models\Product;
use App\Models\Zamzam;
use GrahamCampbell\ResultType\Success;
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
                $count = 0;
                foreach ($items as $item) {
                    $count += $item['quantity'];
                }
                return response()->json([
                    'success' => true,
                    'subTotal' => $cart['subTotal'],
                    'total' => $cart['total'],
                    'items' => $count,
                    'products' => CartResource::collection($items)
                ], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Your cart is empty!'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Your cart is empty!'], 200);
        }
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if ($product) {
            if (Auth::user()->cart) {

                $selectedItem = CartItem::where('cart_id', Auth::user()->cart->id)->where('title', $product->title)->where('description', $product->description)->where('amount', $product->amount)->where('image', $product->image)->first();

                if ($selectedItem) {
                    $selectedItem->old_price += $selectedItem->old_price / $selectedItem->quantity;
                    $selectedItem->new_price += $selectedItem->new_price / $selectedItem->quantity;
                    $selectedItem->quantity += 1;
                    $selectedItem->save();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
                }

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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such product'], 200);
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

                return response()->json(['success' => true, 'message' => 'quantity increased successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
        }
    }

    public function rmQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item) {

            if ($item->carts->user->id == Auth::user()->id) {

                if ($item->quantity == 1 || $item->quantity == 0) {
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

                    return response()->json([
                        'success' => true,
                        'message' => 'item removed form cart successfully'
                    ], 200);
                } else {

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

                    return response()->json(['success' => true, 'message' => 'quantity decreased successfully'], 200);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
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

                return response()->json(['success' => true, 'message' => 'item removed form cart successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
        }
    }

    public function zamzamToCart($id)
    {
        $zamzam = Zamzam::find($id);
        if ($zamzam) {
            if (Auth::user()->cart) {

                $selectedItem = CartItem::where('cart_id', Auth::user()->cart->id)->where('title', $zamzam->title)->where('description', $zamzam->description)->where('amount', $zamzam->amount)->where('image', $zamzam->image)->first();

                if ($selectedItem) {
                    $selectedItem->old_price += $selectedItem->old_price / $selectedItem->quantity;
                    $selectedItem->new_price += $selectedItem->new_price / $selectedItem->quantity;
                    $selectedItem->quantity += 1;
                    $selectedItem->save();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
                }

                $item['title'] = $zamzam->title;
                $item['description'] = $zamzam->description;
                $item['amount'] = $zamzam->amount;
                $item['image'] = $zamzam->image;
                $item['old_price'] = $zamzam->old_price;
                $item['new_price'] = $zamzam->new_price;
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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            } else {

                $cart['user_id'] = Auth::user()->id;
                Cart::create($cart);

                $item['title'] = $zamzam->title;
                $item['description'] = $zamzam->description;
                $item['amount'] = $zamzam->amount;
                $item['image'] = $zamzam->image;
                $item['old_price'] = $zamzam->old_price;
                $item['new_price'] = $zamzam->new_price;
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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such product'], 200);
        }
    }

    public function masajedToCart($id)
    {
        $masajed = Masajed::find($id);
        if ($masajed) {
            if (Auth::user()->cart) {

                $selectedItem = CartItem::where('cart_id', Auth::user()->cart->id)->where('title', $masajed->title)->where('description', $masajed->description)->where('amount', $masajed->amount)->where('image', $masajed->image)->first();

                if ($selectedItem) {
                    $selectedItem->old_price += $selectedItem->old_price / $selectedItem->quantity;
                    $selectedItem->new_price += $selectedItem->new_price / $selectedItem->quantity;
                    $selectedItem->quantity += 1;
                    $selectedItem->save();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
                }

                $item['title'] = $masajed->title;
                $item['description'] = $masajed->description;
                $item['amount'] = $masajed->amount;
                $item['image'] = $masajed->image;
                $item['old_price'] = $masajed->old_price;
                $item['new_price'] = $masajed->new_price;
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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            } else {

                $cart['user_id'] = Auth::user()->id;
                Cart::create($cart);

                $item['title'] = $masajed->title;
                $item['description'] = $masajed->description;
                $item['amount'] = $masajed->amount;
                $item['image'] = $masajed->image;
                $item['old_price'] = $masajed->old_price;
                $item['new_price'] = $masajed->new_price;
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

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            }
        } else {
            return response()->json(['message' => 'there is no such product'], 200);
        }
    }
}
