<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use App\Http\Requests\Adverts\AttributeRequest;
use App\Http\Requests\Adverts\PhotosRequest;
use App\UseCases\Adverts\AdvertService;
use Illuminate\Support\Facades\Gate;

class ManageController extends Controller
{
    private $service;

    public function __construct(AdvertService $service)
    {
        $this->service = $service;
    }

    public function attributes(Advert $advert)
    {
        $this->checkAccess($advert);

        return view('adverts.edit.attributes', compact('advert'));
    }

    public function updateAttributes(AttributeRequest $request, Advert $advert)
    {
        $this->checkAccess($advert);

        try{
            $this->service->editAttributes($advert->id, $request);
        } catch (\DomainException $e){
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function updatePhotos(PhotosRequest $request, Advert $advert)
    {
        $this->checkAccess($advert);

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

        return redirect()->route('adverts.show', $advert);
    }

    private function checkAccess(Advert $advert) :void
    {
        if(!Gate::allows('manage-own-advert', $advert)){
            abort(403);
        }
    }
}
