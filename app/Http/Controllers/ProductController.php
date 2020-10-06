<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductDetail;
use App\Order;
use App\OrderDetail;
use App\Http\Requests\OrderRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::whereNotNull('parent_id')->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function showProductByCategory($id)
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $category = Category::with('products.images')->whereNotNull('parent_id')->findOrFail($id);
        $products = $category->products;

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function productDetail($id)
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $product = Product::findOrFail($id);
        $cart = session('cart');
        $totalQuantity = 0;
        if (isset($cart)) {
            foreach ($cart as $cartItem) {
                $totalQuantity += $cartItem['quantity'];
            }
        }

        session()->put('totalQuantity', $totalQuantity);

        return view('fashi.user.product', compact(['product', 'categories']));
    }

    public function showCart()
    {
        $cart = session('cart');

        return view('fashi.user.shopping-cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $productDetail = ProductDetail::where('product_id', $id)->where('color', $request->color)->where('size', $request->size)->first();

        if ($productDetail) {
            $productDetailId = $productDetail->id;
        }

        $cart = session()->get('cart');

        try {
            if (!$cart) {
                $cart = [
                    $productDetailId => [
                        "product_detail_id" => $productDetailId,
                        "product_id" => $request->product_id,
                        "quantity" => $request->quantity,
                        "color" => $request->color,
                        "size" => $request->size,
                        "name" => $productDetail->product->name,
                        "price" => $productDetail->product->price,
                        "image" => $productDetail->product->images->first()->link_to_image,
                    ]
                ];

                session()->put('cart', $cart);
            } else {
                if (isset($cart[$productDetailId])) {
                    $cart[$productDetailId]['quantity'] += $request->quantity;
                    session()->put('cart', $cart);
                } else {
                    $cart[$productDetailId] = [
                        "product_detail_id" => $productDetailId,
                        "product_id" => $request->product_id,
                        "quantity" => $request->quantity,
                        "color" => $request->color,
                        "size" => $request->size,
                        "name" => $productDetail->product->name,
                        "price" => $productDetail->product->price,
                        "image" => $productDetail->product->images->first()->link_to_image,
                    ];
                    session()->put('cart', $cart);
                }
            }

            $totalQuantity = 0;
            foreach ($cart as $cartItem) {
                $totalQuantity += $cartItem['quantity'];
            }
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
                    toast(trans('message.cart.update.success'),'success');

                    return back();
                }
            }

            session()->put('cart', $cart);
        } catch (Exception $e) {
            toast(trans('message.cart.update.error'),'error');

            return back();
        }

        toast(trans('message.cart.update.success'),'success');

        return back();
    }

    public function removeCartItem(Request $request, $id)
    {
        $cart = session()->get('cart');
        $productDetailId = ProductDetail::findOrFail($id)->id;

        try {
            session()->forget('cart.' . $productDetailId);
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'message' => trans('text.delele_error'),
                'icon' => 'error',
            ];

            return response()->json($result);
        }

        $result = [
            'status' => true,
            'message' => trans('text.delele_success'),
            'icon' => 'success',
        ];

        return response()->json($result);
    }

    public function removeAllCart(Request $request)
    {
        try {
            session()->flush();
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'message' => trans('text.delele_error'),
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

    public function checkOut()
    {
        $cart = session('cart');
        if (auth()->check()) {
            $user = auth()->user();
        }

        return view('fashi.user.check-out', compact(['cart', 'user']));
    }

    public function createOrder(OrderRequest $request)
    {
        $cart = session('cart');
        $data = $request->only([
            'name',
            'email',
            'phone',
            'address',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = config('order.pending');

        try {
            if (isset($cart)) {
                $order  = Order::create($data);

                foreach ($cart as $productDetailId => $cartItem) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_detail_id' => $productDetailId,
                        'quantity' => $cartItem['quantity'],
                    ]);
                }

                session()->forget('cart');
            } else {
                alert()->error(trans('text.error'), trans('text.order_error'));

                return back();
            }
        } catch (Exception $e) {
            alert()->error(trans('text.error'), trans('text.order_error'));

            return back();
        }

        alert()->success(trans('text.success'), trans('text.order_success'));

        return back();
    }
}
