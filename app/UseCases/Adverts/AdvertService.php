<?php

namespace App\UseCases\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Entity\User;
use App\Http\Requests\Adverts\AttributeRequest;
use App\Http\Requests\Adverts\CreateRequest;
use App\Http\Requests\Adverts\PhotosRequest;
use App\Http\Requests\Adverts\RejectRequest;
use Illuminate\Support\Facades\DB;

class AdvertService
{
    public function create($userId, $categoryId, $regionId, CreateRequest $request): Advert
    {
        /* @var User $user */
        $user = User::findOfFail($userId);
        /* @var Category $category */
        $category = Category::findOfFail($categoryId);
        /* @var Region $region */
        $region = $regionId ? Region::findOfFail($regionId) : null;

        return DB::transaction(function () use ($request, $user, $category, $region) {

            /* @var Advert $advert */
            $advert = Advert::make([
                'title' => $request['title'],
                'content' => $request['content'],
                'price' => $request['price'],
                'address' => $request['address'],
                'status' => Advert::STATUS_DRAFT
            ]);

            $advert->user()->associate($user);
            $advert->region()->associate($region);
            $advert->category()->associate($category);

            $advert->saveOrFail();

            foreach ($category->allAttributes() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $advert->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value
                    ]);
                }
            }
            return $advert;
        });

    }

    public function addPhotos($id, PhotosRequest $request): void
    {
        $advert = $this->getAdvert($id);

        DB::transaction(function () use ($request, $advert) {
            foreach ($request['files'] as $file) {
                $advert->photos()->create([
                    'file' => $file->store('adverts')
                ]);
            }
        });
    }

    public function getAdvert($id) :Advert
    {
        return Advert::findOrFail($id);
    }

    public function sendToModeration($id) :void
    {
        $advert = $this->getAdvert($id);
        $advert->sendToModeration();
    }

    public function reject($id, RejectRequest $request) :void
    {
        $advert = $this->getAdvert($id);
        $advert->reject($request['reason']);
    }

    public function editAttributes($id, AttributeRequest $request) :void
    {
        $advert = $this->getAdvert($id);

        DB::transaction(function () use ($request, $advert){
           foreach ($advert->values as $value){
               $value->delete();
           }

           foreach ($advert->category->allAttributes() as $attribute){
               $value = $request['attributes'][$attribute->id] ?? null;
               if(!empty($value)){
                   $advert->values()->create([
                      'attribute_id' => $attribute->id,
                       'value' => $value
                   ]);
               }
           }
        });
    }

    public function remove($id) :void
    {
        $advert = $this->getAdvert($id);
        $advert->delete();
    }
}
