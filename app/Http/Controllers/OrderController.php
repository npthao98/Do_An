<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\ProductInfor;
use App\Repositories\Order\OrderRepositoryInterface;
use Carbon\Carbon;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo
    ) {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $orders = $user->customer->orders->sortByDesc('id');
        }

        $ordersSuccess = $orders->where('status', config('status.order.success'));
        $ordersPending = $orders->where('status', config('status.order.pending'));
        $ordersShipping = $orders->where('status', config('status.order.shipping'));
        $ordersCanceled = Order::withTrashed()->where('customer_id', $user->customer->id)
            ->where('status', config('status.order.canceled'))
            ->get()
            ->sortByDesc('id');

        return view('fashi.user.list-orders', compact(
            'user',
            'ordersSuccess',
            'ordersPending',
            'ordersShipping',
            'ordersCanceled'
        ));
    }

    public function create()
    {
        $cart = session('cart');
        if (auth()->check()) {
            $user = auth()->user();
        }

        return view('fashi.user.check-out', compact('cart', 'user'));
    }

    public function store(OrderRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        }

        $cart = session('cart');
        $data = $request->only([
            'receiver',
            'phone',
            'address',
        ]);

        $data['customer_id'] = $user->customer->id;
        $data['status'] = config('status.order.pending');
        $data['time'] = Carbon::now()->format('Y-m-d H-i-s');
        $data['fee_shipment'] = config('order.fee_shipment');
        $data['type_payment'] = 'COD';
        $data['total_price'] = 0;

        try {
            if (isset($cart)) {
                $kt = true;
                foreach ($cart as $cartItem) {
                    $productInfor = ProductInfor::find($cartItem['product_infor_id']);
                    if ($cartItem['quantity'] > $productInfor->quantity) {
                        $kt = false;
                    }
                }

                if ($kt) {
                    $order  = Order::create($data);
                    $totalPrice = 0;
                    foreach ($cart as $cartItem) {
                        $totalPrice += $cartItem['price'] * $cartItem['quantity'];
                        $product = ProductInfor::find($cartItem['product_infor_id'])->product;
                        Item::create([
                            'order_id' => $order->id,
                            'product_infor_id' => $cartItem['product_infor_id'],
                            'quantity' => $cartItem['quantity'],
                            'price_import' => $product->price_import,
                            'price_sale' => $product->price_sale,
                        ]);
                    }
                    $order->update([
                        'total_price' => $totalPrice,
                    ]);

                    $this->orderRepo->recalculateProductAfterOrder($order->id);

                    $productOrders = '';

                    foreach ($order->items as $items) {
                        $productName = $items->productInfor->product->name;
                        $productSize = $items->productInfor->size;
                        $productColor = $items->productInfor->color;
                        $orderQuantity = $items->quantity;

                        $productOrders .= $productName . '(' . $productSize . ', ' . $productColor . ', ' . $orderQuantity . ')' . ', ';
                    };

                    session()->forget('cart');
                    session()->forget('totalQuantity');
                } else {
                    alert()->error(trans('text.error'), trans('text.order_error'));

                    return back();
                }
            } else {
                alert()->error(trans('text.error'), trans('text.order_error'));

                return back();
            }
        } catch (Exception $e) {
            alert()->error(trans('text.error'), trans('text.order_error'));

            return back();
        }

        alert()->success(trans('text.success'), trans('text.order_success'));

        return redirect(route('user.orders'));
    }
}
