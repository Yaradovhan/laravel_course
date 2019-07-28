<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use App\Http\Requests\Adverts\AttributeRequest;
use App\Http\Requests\Adverts\PhotosRequest;
use App\UseCases\Adverts\AdvertService;

class ManageController extends Controller
{
    private $service;

    public function __construct(AdvertService $service)
    {
        $this->service = $service;
        $this->middleware(FilledProfile::class);
    }

    public function attributes(Advert $advert)
    {
        return view('adverts.edit.attributes', compact('advert'));
    }

    public function updateAttributes(AttributeRequest $request, Advert $advert)
    {
        try{
            $this->service->editAttributes($advert->id, $request);
        } catch (\DomainException $e){
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function updatePhotos(PhotosRequest $request, Advert $advert)
    {
        try{
            $this->service->addPhotos($advert->id, $request);
        } catch (\DomainException $e){
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function destroy(Advert $advert)
    {
        try{
            $this->service->remove($advert->id);
        } catch (\DomainException $e){
            return back()->with('error', $e->getMessage());
        }

//        return route('adverts.show', $advert);
        return route('adverts.index');
    }

    public function close(Advert $advert)
    {
//        $this->checkAccess($advert);
        try {
            $this->service->close($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

//        return redirect()->route('adverts.show', $advert);
        return route('adverts.show', $advert);

    }

    public function send(Advert $advert)
    {
//        $this->checkAccess($advert);
        try {
            $this->service->sendToModeration($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

//        return redirect()->route('adverts.show', $advert);
        return route('adverts.show', $advert);
    }

}
