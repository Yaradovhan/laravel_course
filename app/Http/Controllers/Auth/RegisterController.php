<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use App\Entity\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/cabinet';

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function form()
    {
        return view('auth.register');
    }

    public function verify($token)
    {
        if(!$user = User::where('verify_code', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry, your link cant be identified');
        }

        if($user->status !== User::STATUS_WAIT){
            return redirect()->route('login')
                ->with('error', 'Your email are already verified');
        }

        $user->status = User::STATUS_ACTIVE;
        $user->verify_code = null;
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Your e-mail are verified. You can now login');
    }

    public function register(RegisterRequest $request)
    {
        if(!true){
            return redirect()->route('cabinet')->exceptInput();
        }

        $user = $this->create($request);

        Auth::login($user);

        return redirect()->route('cabinet');
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'verify_code' => Str::random(),
            'status' => User::STATUS_WAIT
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
