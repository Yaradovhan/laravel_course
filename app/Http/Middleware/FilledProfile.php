<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FilledProfile
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->hasFailedProfile()) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return $next($request);
    }
}
