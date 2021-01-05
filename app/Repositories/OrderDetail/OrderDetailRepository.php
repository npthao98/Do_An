<?php
namespace App\Repositories\OrderDetail;

use App\Repositories\BaseRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Models\Item;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return Item::class;
    }
}
