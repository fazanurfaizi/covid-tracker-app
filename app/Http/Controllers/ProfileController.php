<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function edit() {
        return view('user.edit');
    }

    public function update(ProfileRequest $request) {
        auth()->user()->update($request->all());

        return back()->withSuccess(__('user.updated'));
    }

    public function password(PasswordRequest $request) {
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->withPasswordSuccess(__('user.password'));
    }

}
