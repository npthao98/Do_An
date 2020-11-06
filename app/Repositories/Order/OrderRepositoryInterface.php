<?php
namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function updateOrderSuccess($id);

    public function updateOrderPending($id);

    public function updateOrderCancel($id);

    public function recalculateProductAfterOrder($id); 
}
