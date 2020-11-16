<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $orderRepo;
    protected $notificationRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo, 
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->notificationRepo = $notificationRepo;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataTitle = [
                trans('text.new_order'),
                trans('text.cancel_order'),
            ];

            $data = array();
            $dataOrderInMonth = array();
            $dataCancelOrderInMonth = array();
            $dataMonths = [
                trans('text.jan'),
                trans('text.feb'),
                trans('text.mar'),
                trans('text.apr'),
                trans('text.may'),
                trans('text.june'),
                trans('text.july'),
                trans('text.aug'),
                trans('text.sep'),
                trans('text.oct'),
                trans('text.nov'),
                trans('text.dec'),
            ];

            for ($i = 1; $i <= config('order.month_in_year'); $i++) { 
                $countOrder = $this->orderRepo->countOrderByMonth($i);
                $countCancelOrder = $this->orderRepo->countCancelOrderByMonth($i);

                array_push($dataOrderInMonth, $countOrder);
                array_push($dataCancelOrderInMonth, $countCancelOrder);
            }

            $data = [
                $dataTitle,
                $dataMonths,
                $dataOrderInMonth,
                $dataCancelOrderInMonth,
            ];
            
            return response()->json($data, 200);
        }

        return view('fashi.admin.dashboard');
    }

    public function listNotification()
    {
        $notifications = $this->notificationRepo->getAll();
        
        return view('fashi.admin.notification.index', compact('notifications'));
    }

    public function deleteNotification($id)
    {   
        try {
            $this->notificationRepo->delete($id);
        } catch (Exception $e) {
            toast(trans('message.notification.delete.error'), 'error');

            return back();
        }

        toast(trans('message.notification.delete.success'), 'success');

        return redirect()->route('admin.list_notification');
    }

    public function deleteAllNotification()
    {   
        try {
            $this->notificationRepo->destroyAllNotification();
        } catch (Exception $e) {
            toast(trans('message.notification.delete.error'), 'error');

            return back();
        }

        toast(trans('message.notification.delete.success'), 'success');

        return redirect()->route('admin.list_notification');
    }
}
