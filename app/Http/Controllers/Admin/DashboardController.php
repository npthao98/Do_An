<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
	protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo) 
    {
        $this->orderRepo = $orderRepo;
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
}
