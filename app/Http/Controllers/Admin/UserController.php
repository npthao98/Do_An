<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('fashi.admin.profile.index', compact('users'));
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        try {
            if ($user->role == config('user.customer')) {
                $user->update(['role' => config('user.admin')]);
            } else {
                $user->update(['role' => config('user.customer')]);
            }
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.user.role.error'), 'error');

            return back();
        }

        toast(trans('message.user.role.success'), 'success');

        return back();
    }
}
