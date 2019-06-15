<?php


namespace App\UseCases\Auth;

use App\Entity\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Mail\Mailer as MailerInterface;
use Illuminate\Events\Dispatcher;

class RegisterService
{
    private $mailer;
    private $dispatcher;

    public function __construct(MailerInterface $mailer, Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->mailer = $mailer;
    }
    public function register(RegisterRequest $request)
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id) :void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->verify();
    }

}
