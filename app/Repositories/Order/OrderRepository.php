<?php
namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function updateOrderSuccess($id)
    {
        $order = $this->model->find($id);

        foreach ($order->orderDetails->load('productDetail') as $orderDetail) {
            $productDetail = $orderDetail->productDetail;
            $product = $productDetail->product;

            $orderDetailQuantity = $orderDetail->quantity;
            $productDetailQuantity = $productDetail->quantity;

            $productDetailInStock = $productDetailQuantity - $orderDetailQuantity;
            $productInStock = $product->in_stock - $orderDetailQuantity;

            if ($productDetailInStock >= 0 || $productInStock >= 0) {
                $productDetail->update(['quantity' => $productDetailInStock]);
                $product->update(['in_stock' => $productInStock]);
            } else {
                toast(trans('message.cart.update.error'), 'error');

                return back();
            }
        }

        $order->update(['status' => config('order.success')]);

        return true;
    }

    public function updateOrderCancel($id)
    {
        $order = $this->model->find($id);
        $order->update(['status' => config('order.cancel')]);
    }

    public function updateOrderPending($id)
    {
        $order = $this->model->find($id);
        $order->update(['status' => config('order.pending')]);
    }
}
