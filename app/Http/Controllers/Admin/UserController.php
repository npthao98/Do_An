<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepo->getAll();

        return view('fashi.admin.profile.index', compact('users'));
    }

    public function changeRole($id)
    {
        try {
            $this->userRepo->updateRole($id);
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.user.role.error'), 'error');

            return back();
        }

        toast(trans('message.user.role.success'), 'success');

        return back();
    }
}
