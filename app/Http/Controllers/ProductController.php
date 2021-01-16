<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInfor;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $orderRepo;
    protected $productRepo;
    protected $categoryRepo;
    protected $orderDetailRepo;
    protected $commentRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo,
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $categoryRepo,
        OrderDetailRepositoryInterface $orderDetailRepo,
        CommentRepositoryInterface $commentRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->orderDetailRepo = $orderDetailRepo;
        $this->commentRepo = $commentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepo->getAll();
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function newProduct()
    {
        $products = $this->productRepo->orderByCreatedAt();
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function showProductByCategory($id)
    {
        $categories = $this->categoryRepo->findChildrenCategory()->get();
        $category = $this->categoryRepo->findOneChildrenCategory($id);
        $products = $category->products;

        return view('fashi.user.shop', compact('products', 'categories'));
    }

    public function productDetail(Request $request, $id)
    {
        $rating = false;
        if (Auth::check() && !Auth::user()->employee) {
            $client = new \GuzzleHttp\Client();

            $request = $client->get('http://localhost:5000/recommendations', [
                'query' => ['customer' => Auth::user()->customer->id]
            ]);
            $rate = Rate::where([
                'customer_id' => Auth::user()->customer->id,
                'product_id' => $id,
                'rate' => 0,
            ])->first();

            if ($rate) {
                $rating = true;
            }

            $response = $request->getBody();
            $recommendations = json_decode($response)->data;
        } else {
            $recommendations = Product::take(7)->pluck('id')->toArray();
        }
        if (in_array($id, $recommendations)) {
            unset($recommendations[array_search($id, $recommendations)]);
        }
        $products = Product::whereIn('id', $recommendations)->get();
        $categories = $this->categoryRepo->findChildrenCategory()->get();
        $product = $this->productRepo->find($id);
        $rates = Rate::where('product_id', $product->id)
            ->where('rate' , '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(config('comment.paginate'));
        $cart = session('cart');
        $totalQuantity = 0;
        if (isset($cart)) {
            foreach ($cart as $cartItem) {
                $totalQuantity += $cartItem['quantity'];
            }
        }

        session()->put('totalQuantity', $totalQuantity);

        return view('fashi.user.product', compact(
            'product',
            'categories',
            'rates',
            'products',
            'rating'
        ));
    }

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

    public function removeAllCart(Request $request)
    {
        try {
            session()->forget('cart');
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

    public function search(Request $request)
    {
        $nameProduct = $request->name;
        $products = $this->productRepo->searchProduct($nameProduct);
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        if ($products->count() === 0) {
            return view('fashi.user.404', compact(['categories']));
        }

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function orderCancel($id)
    {
        try {
            $this->orderRepo->updateOrderCancel($id);
            $order = $this->orderRepo->getOneCancelOrder($id);
        } catch (Exception $e) {
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();
    }
}
