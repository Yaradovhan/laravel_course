<?php

namespace App\UseCases\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Entity\User;
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
}
