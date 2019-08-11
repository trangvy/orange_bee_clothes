<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $checkCart = false;

        if (is_array($cart->items) && array_key_exists($id, $cart->items)) {
            $checkCart = true;
        }
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        $imagePath = asset(config('product.image_path')).$cart->items[$id]['item']->image;

        $result = [
            'total_count' => $cart->totalQuantity,
            'product_quantity' => $cart->items[$id]['quantity'],
            'product_name' => $cart->items[$id]['item']->name,
            'product_image' => $imagePath,
            'product_price' => $cart->items[$id]['price'],
            'totalPrice' => $cart->totalPrice,
            'id' => $id,
            'check_cart' => $checkCart,
        ];

        return response()->json($result);
    }

    public function shoppingCart() {
        if (!Session::has('cart')) {
            return view('frontend.shopping_cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $data = [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
        ];

        return view('frontend.shopping_cart', $data);
    }

    public function delCartAll() {
        if (Session::has('cart')) {
            Session::forget('cart');
        }

        return view('frontend.shopping_cart');
    }

    public function deleteCartItem($id) {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $product = Product::find($id);

            if ($cart->deleteCartItem($product, $id)) {
                Session::put('cart', $cart);
                $newCart = Session::get('cart');
                $items = $newCart->items;
                if (empty($items)) {
                    Session::forget('cart');
                    Session::save();
                    $result = [
                        'status' => true,
                        'itemEmpty' => true,
                        'message' => __('cart.delete_success')
                    ];
                } else {
                    $itemPrice = $newCart->items[$id]['price'];
                    $totalPrice = $newCart->totalPrice;
                    $result = [
                        'status' => true,
                        'itemEmpty' => false,
                        'message' => __('cart.delete_success'),
                        'itemPrice' => $itemPrice,
                        'totalPrice' => $totalPrice
                    ];
                }
            } else {
                $result = [
                    'status' => false,
                    'message' => __('cart.not_found')
                ];
            }

        } else {
            $result = [
                'status' => false,
                'message' => __('cart.delete_fail')
            ];
        }
        return response()->json($result);
    }

    public function upCartQuantity($id) {
        if (session()->has('cart')) {
            $product = Product::find($id);
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            if ($cart->upQuantity($product, $product->id)) {
                session()->put('cart', $cart);
                $newCart = Session::get('cart');
                $itemPrice = $newCart->items[$id]['price'];
                $totalPrice = $newCart->totalPrice;
                $total = $cart->totalQuantity + 1;
                $result = [
                    'status' => true,
                    'message' => __('cart.updated'),
                    'itemPrice' => $itemPrice,
                    'totalPrice' => $totalPrice,
                    'total' => $total,
                ];

            } else {
                $result = [
                    'status' => false,
                    'message' => __('cart.not_found')
                ];
            }
        } else {
            $result = [
                'status' => false,
                'message' => __('cart.update_fail')
            ];
        }

        return response()->json($result);
    }

    public function downCartQuantity($id) {
        if (session()->has('cart')) {
            $product = Product::find($id);
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            if ($cart->downQuantity($product, $product->id)) {
                session()->put('cart', $cart);
                $newCart = session()->get('cart');
                $itemPrice = $newCart->items[$id]['price'];
                $totalPrice = $newCart->totalPrice;
                $result = [
                    'status' => true,
                    'message' => __('cart.updated'),
                    'itemPrice' => $itemPrice,
                    'totalPrice' => $totalPrice
                ];
                $cart->totalQuantity--;
            } else {
                $result = [
                    'status' => false,
                    'message' => __('cart.not_found')
                ];
            }
        } else {
            $result = [
                'status' => false,
                'message' => __('cart.update_fail')
            ];
        }

        return response()->json($result);
    }
}
