<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo
    )
    {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            if (isset($request['success'])) {
                $this->orderRepo->updateOrderSuccess($id);
            } elseif (isset($request['cancel'])) {
                $this->orderRepo->updateOrderCancel($id);
            } elseif (isset($request['shipping'])) {
                $this->orderRepo->updateOrderShipping($id);
            }
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();

    }

    public function destroy($id)
    {
    }
}
