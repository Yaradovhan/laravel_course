<?php

namespace App\Http\Middleware;

use Closure;

class FilledProfile
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if(empty($user->hasFailedProfile())) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return view('cabinet.adverts.edit');
    }
}
