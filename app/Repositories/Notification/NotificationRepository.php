<?php
namespace App\Repositories\Notification;

use App\Repositories\BaseRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Notification;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notification::class;
    }

    public function destroyAllNotification()
    {
        $result = $this->model->truncate();
        
        return true;
    }
}
