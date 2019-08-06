<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Router\AdvertsPath;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    public function index(AdvertsPath $path)
    {
        $query = Advert::active()->with(['category', 'region'])->orderByDesc('published_at');

        if($region = $path->region){
            $query->forRegion($region);
        }
        if($category = $path->category){
            $query->forCategory($category);
        }

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->orderBy('name')->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $adverts = $query->paginate(20);

        return view('adverts.index', compact('adverts', 'category', 'categories', 'region', 'regions'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))){
            abort(403);
        }

        $user = Auth::user();

        return view('adverts.show', compact('advert', 'user'));
    }

    public function phone(Advert $advert) :string
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))){
            abort(403);
        }
        return $advert->user->phone;
    }
}
