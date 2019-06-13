<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Auth\VerifyMail;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, $this->validator());

        if(!true){
            return redirect()->route('cabinet')->exceptInput();
        }

        $user = $this->create($request);

        Auth::login($user);

        return redirect()->route('cabinet');
    }

    public function validator() : array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'verify_token' => Str::random(),
            'status' => User::STATUS_WAIT,
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect()->route('login')->with('success', 'Check your email and click on the link to verify.');
    }
}
