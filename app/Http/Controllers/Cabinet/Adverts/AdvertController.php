<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Http\Middleware\FilledProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{

    public function __construct()
    {
        $this->middleware(FilledProfile::class);
    }

    public function index()
    {
        $advert = Advert::forUser(Auth::user())->orderBy('id')->paginate(20);
        return view('cabinet.adverts.index', compact('advert'));
    }

    public function create()
    {
        return view('cabinet.adverts.create');
    }

    public function edit()
    {
        return view('cabinet.adverts.edit');
    }

    public function v()
    {
        return view('cabinet.adverts.index');
    }
}
