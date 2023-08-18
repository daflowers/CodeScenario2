<?php

namespace App\Http\Controllers;

use App\Models\person_type;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CreateVerificationController extends Controller
{
    public function create(Request $request)
    {
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');

      return view('2fa-verification.verification',[
          'username' => $username,
          'password' => $password
      ]);
    }

    public function store(Request $request)
    {
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');

        $userInfo = [
            'username' => $username,
            'password' => md5($password),
        ];

        User::create($userInfo);

        $type = $_POST['twoFA'];
        if ($type=='Other'){
            $type = $_POST['twoFA-other'];
        }

        $user2FA = [
            'foreign_id' => $username,
            'person_type' => $type
        ];

        person_type::create($user2FA);

        Log::notice('[Login] ' . gethostbyaddr($_SERVER["REMOTE_ADDR"]) . ' | Successful');

        return redirect('/dashboard');
    }
}
