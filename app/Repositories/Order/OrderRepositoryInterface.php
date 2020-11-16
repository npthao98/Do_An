<?php
namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function updateOrderSuccess($id);

    public function updateOrderPending($id);

    public function updateOrderCancel($id);

    public function recalculateProductAfterOrder($id); 

    public function countOrderByMonth($month);

    public function countCancelOrderByMonth($month);

    public function getOneCancelOrder($id);
}
