<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterService;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/cabinet';
    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    public function form()
    {
        return view('auth.register');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_code', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry, your link cant be identified');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')
                ->with('success', 'Your e-mail are verified. You can now login');
        } catch (\DomainException $e) {
            return redirect()->route('login')
                ->with('error', $e->getMessage());
        }


    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return redirect()->route('login')
            ->with('success', "Check your email and click on the link to verify.");
    }

//    protected function registered(Request $request, $user)
//    {
//        $this->guard()->logout();
//
//        return redirect()->route('login')->with('success', 'Check your email and click on the link to verify.');
//    }
}
