<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $orders = $user->orders;
        }

        $ordersSuccess = $orders->where('status', config('order.success'));
        $ordersPending = $orders->where('status', config('order.pending'));

        return view('fashi.user.profile', compact(['user', 'ordersSuccess', 'ordersPending']));
    }

    public function update(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
        }

        try {
            $user->update($request->all());
        } catch (Exception $e) {
            alert()->error(trans('text.error'), trans('text.update_user_error'));

            return back();
        }

        alert()->success(trans('text.success'), trans('text.update_user_success'));

        return back();
    }

    public function viewChangePassword()
    {
        return view('fashi.user.change-password');
    }

    public function changePassword(Request $request)
    {
        $newPassword = $request->new_password;
        $oldPassword = $request->old_password;
        $confirmPassword = $request->confirm_password;
        $user = auth()->user();
        $hashedPassword = auth()->user()->getAuthPassword();

        if (Hash::check($oldPassword, $hashedPassword)) {
            if (($newPassword == $confirmPassword) && $newPassword != '' && $confirmPassword != '' && Str::length($newPassword) >= config('user.length_password')) {
                $user->update(['password' => Hash::make($newPassword)]);
            } else {
                alert()->error(trans('text.error'), trans('message.password.update.error.not_match'));

                return back();
            }
        } else {
            alert()->error(trans('text.error'), trans('message.password.update.error.incorrect'));

            return back();
        }

        alert()->success(trans('text.success'), trans('message.password.update.success'));

        return back();
    }
}
