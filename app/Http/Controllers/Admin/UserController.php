<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('posts')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('admin/users')->withSuccess(__('admin.delete.success'));
    }

    /**
     * Update User Permission
     *
     * @param \App\Models\User $user
     */
    public function permission(User $user) {
        $this->authorize('permission', $user);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect(url()->previous());
    }
}
