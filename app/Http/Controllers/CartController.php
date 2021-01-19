<?php

namespace App\Http\Controllers;

use App\Models\ProductInfor;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session('cart');

        return view('fashi.user.shopping-cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $productInfor = ProductInfor::where([
            'product_id' => $id,
            'color' => $request->color,
            'size' => $request->size,
        ])->first();
        $product = $productInfor->product;

        if ($productInfor) {
            if ($request->quantity > $productInfor->quantity) {
                $result = [
                    'status' => false,
                    'message' => trans('text.quantity_product_not_enough'),
                    'icon' => 'error',
                ];

                return response()->json($result);
            } elseif (!is_numeric($request->quantity)) {
                $result = [
                    'message' => trans('text.quantity_must_be_numeric'),
                    'icon' => 'error',
                ];

                return response()->json($result);
            } elseif ($request->quantity <= 0) {
                $result = [
                    'status' => false,
                    'message' => trans('text.negative'),
                    'icon' => 'error',
                ];

                return response()->json($result);
            }

            $productInforId = $productInfor->id;
        } else {
            $result = [
                'message' => trans('text.no_product_details'),
                'icon' => 'error',
            ];

            return response()->json($result);
        }

        $cart = session()->get('cart');

        try {
            if (!$cart) {
                $cart = [
                    $productInforId => [
                        "product_infor_id" => $productInforId,
                        "product_id" => $request->product_id,
                        "quantity" => $request->quantity,
                        "color" => $request->color,
                        "size" => $request->size,
                        "name" => $product->name,
                        "price" => $product->price_sale,
                        "image" => $product->link_to_image_base,
                    ]
                ];

                session()->put('cart', $cart);
            } else {
                if (isset($cart[$productInforId])) {
                    $cart[$productInforId]['quantity'] += $request->quantity;
                    session()->put('cart', $cart);
                } else {
                    $cart[$productInforId] = [
                        "product_infor_id" => $productInforId,
                        "product_id" => $request->product_id,
                        "quantity" => $request->quantity,
                        "color" => $request->color,
                        "size" => $request->size,
                        "name" => $product->name,
                        "price" => $product->price_sale,
                        "image" => $product->link_to_image_base,
                    ];
                    session()->put('cart', $cart);
                }
            }

            $totalQuantity = 0;
            foreach ($cart as $cartItem) {
                $totalQuantity += $cartItem['quantity'];
            }
            session()->put('totalQuantity', $totalQuantity);
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'quantity' => 0,
                'message' => trans('text.add_to_cart_error'),
                'icon' => 'error',
            ];

            return response()->json($result);
        }

        $result = [
            'status' => true,
            'quantity' => $totalQuantity,
            'message' => trans('text.add_to_cart_success'),
            'icon' => 'success',
        ];

        return response()->json($result);
    }

    public function updateCart(Request $request)
    {
        $cart = session('cart');

        $quantity = $request->quantity;

        try {
            $totalPrice = 0;
            foreach ($cart as $key => $cartItem) {
                if ($quantity[$key] >= 1) {
                    $cart[$key]['quantity'] = $quantity[$key];
                    $subTotal = $cart[$key]['quantity'] * $cart[$key]['price'];
                    $totalPrice += $subTotal;
                } else {
                    toast(trans('message.cart.update.error'),'error');

                    return back();
                }
            }

            session()->put('cart', $cart);
        } catch (Exception $e) {
            toast(trans('message.cart.update.error'),'error');

            return back();
        }
        $totalQuantity = 0;
        foreach ($cart as $cartItem) {
            $totalQuantity += $cartItem['quantity'];
        }
        session()->put('totalQuantity', $totalQuantity);

        toast(trans('message.cart.update.success'),'success');

        return back();
    }

    public function removeCartItem(Request $request, $id)
    {
        $cart = session()->get('cart');
        $productInforId = ProductInfor::find($id)->id;

        try {
            session()->forget('cart.' . $productInforId);
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'message' => trans('text.delete_error'),
                'icon' => 'error',
            ];

            return response()->json($result);
        }

        $result = [
            'status' => true,
            'message' => trans('text.delete_success'),
            'icon' => 'success',
        ];

        return response()->json($result);
    }
}
