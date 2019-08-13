<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\SearchRequest;
use App\Http\Router\AdvertsPath;
use App\UseCases\Adverts\SearchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function index(SearchRequest $request, AdvertsPath $path)
    {
        $query = Advert::active()->with(['category', 'region'])->orderByDesc('published_at');

        $region = $path->region;
        $category = $path->category;

//        if ($region = $path->region) {
//            $query->forRegion($region);
//        }
//        if ($category = $path->category) {
//            $query->forCategory($category);
//        }

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->orderBy('name')->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $adverts =$this->search->search($category, $region, $request, 20, $request->get('page', 1));

        return view('adverts.index', compact(
            'adverts',
            'category', 'categories',
            'region', 'regions'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        $user = Auth::user();

        return view('adverts.show', compact('advert', 'user'));
    }

    public function phone(Advert $advert): string
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }
        return $advert->user->phone;
    }
}
