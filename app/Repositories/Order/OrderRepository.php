<?php
namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function updateOrderSuccess($id)
    {
        $order = $this->model->find($id);
        $order->update(['status' => config('order.success')]);
    }

    public function updateOrderCancel($id)
    {
        $order = $this->model->find($id);

        foreach ($order->items->load('productInfor') as $item) {
            $productInfor = $item->productInfor;

            $itemQuantity = $item->quantity;
            $productInforQuantity = $productInfor->quantity;

            $productInforInStock = $productInforQuantity + $itemQuantity;

            if ($productInforInStock >= 0) {
                $productInfor->update(['quantity' => $productInforInStock]);
            } else {
                toast(trans('message.cart.update.error'), 'error');

                return back();
            }
        }

        $order->update(['status' => config('status.order.canceled')]);
        $order->delete();
    }

    public function updateOrderPending($id)
    {
        $order = $this->model->find($id);
        $order->update(['status' => config('order.pending')]);
    }

    public function recalculateProductAfterOrder($id)
    {
        $order = $this->model->find($id);

        foreach ($order->items->load('productInfor') as $item) {
            $productInfor = $item->productInfor;

            $orderDetailQuantity = $item->quantity;
            $productDetailQuantity = $productInfor->quantity;

            $productInforInStock = $productDetailQuantity - $orderDetailQuantity;

            if ($productInforInStock >= 0) {
                $productInfor->update(['quantity' => $productInforInStock]);
            } else {
                toast(trans('message.cart.update.error'), 'error');

                return back();
            }
        }

        return true;
    }

    public function countOrderByMonth($month)
    {
        $result = $this->model->whereMonth('created_at', $month)
            ->count('id');

        return $result;
    }

    public function countCancelOrderByMonth($month)
    {
        $result = $this->model->onlyTrashed()->whereMonth('deleted_at', $month)
            ->count('id');

        return $result;
    }

    public function getOneCancelOrder($id)
    {
        $result = $this->model->onlyTrashed()->where('id', $id)->get();;

        return $result;
    }
}
