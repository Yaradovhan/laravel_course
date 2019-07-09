<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdvertsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(empty($user->hasFailedProfile())) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return view('cabinet.adverts.index');
    }

    public function create()
    {
        $user = Auth::user();

        if(empty($user->hasFailedProfile())) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return view('cabinet.adverts.create');
    }

    public function edit()
    {
        $user = Auth::user();

        if(empty($user->hasFailedProfile())) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return view('cabinet.adverts.edit');
    }

    public function v()
    {
        $user = Auth::user();

        if(empty($user->hasFailedProfile())) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please, verify your profile and phone');
        }

        return view('cabinet.adverts.index');
    }
}
