<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use config\session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {

       $login = request()->validate([
            'username' => 'required|max:255|min:3|unique:users,username',
            'password' => 'required|max:255|min:8'
        ]);

       $request->session()->put('username', $request->input('username'));
       $request->session()->put('password', $request->input('password'));


       return redirect('/2fa-verification');
    }

}
