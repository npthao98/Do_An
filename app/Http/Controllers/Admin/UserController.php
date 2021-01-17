<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Person::withTrashed()->get();

        return view('fashi.admin.profile.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = Person::withTrashed()->where('id', $id)->first();
        if (isset($request['lock'])){
            toast(trans('message.user.lock.success'), 'success');
            $user->delete();
        } elseif (isset($request['unlock'])) {
            $user->restore();
            toast(trans('message.user.unlock.success'), 'success');
        } elseif (isset($request['changePW'])) {
            $user->update([
                'password' => bcrypt('password'),
            ]);
            toast(trans('message.user.change_PW.success'), 'success');
        }

        return back();
    }
}
