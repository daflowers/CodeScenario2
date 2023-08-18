<?php

namespace App\Http\Controllers;

use App\Models\person_type;
use Illuminate\Http\Request;
use App\Models\User;
use config\session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function login(Request $request)
    {

        $inputs = request()->validate([
            'username' => 'required|max:255|min:3',
            'password' => 'required|max:255|min:8'
        ]);

        $user = User::query()->where(['username' => $inputs['username'], 'password' => md5($inputs['password'])]);
        if (!empty($user)) {
            $request->session()->put('temp_login', $request->input('username'));
            return redirect('/verify');
        } else {
            $this->logout();
        }
    }

    public function verify_view()
    {
        $tempLogin = session('temp_login');
        if (!empty($tempLogin)) {
            return view('verify');
        } else {
            $this->clearSession();
            return redirect('/');
        }
    }

    public function verify(Request $request)
    {
        $inputType = $request->person_type;
        $tempLogin = session('temp_login');
        if (!empty($tempLogin) && !empty($inputType)) {
            $personType = person_type::where('foreign_id', $tempLogin)->first();
            if ($inputType == $personType['person_type']) {
                $request->session()->put('username', $tempLogin);

                Log::notice('[Login] ' . gethostbyaddr($_SERVER["REMOTE_ADDR"]) . ' | Successful');

                return redirect('/dashboard');
            } else {
                $this->clearSession();
                Log::notice('[Login] ' . gethostbyaddr($_SERVER["REMOTE_ADDR"]) . ' | Unsuccessful');

                return redirect('/');
            }
        } else {
            $this->clearSession();

            Log::notice('[Login] ' . gethostbyaddr($_SERVER["REMOTE_ADDR"]) . ' | Unsuccessful');

            return redirect('/');
        }
    }

    public function clearSession() {
        session()->flush();
    }
    public function logout()
    {
        $this->clearSession();
        return redirect('/');
    }

}
