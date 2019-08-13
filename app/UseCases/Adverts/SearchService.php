<?php

namespace App\UseCases\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Requests\Adverts\SearchRequest;
use Elasticsearch\Client;
use Illuminate\Pagination\Paginator;

class SearchService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(?Category $category, ?Region $region, SearchRequest $request, int $perPage, int $page): Paginator
    {
        $response = $this->client->search([
            'index' => 'app',
            'type' => 'adverts',
            'body' => [
                'sort' => [
                    ['published_at' => ['order' => 'desc']],
                ],
            ]
        ]);

        $ids = array_column($response['hits']['hits'], '_id');

        $items = Advert::active()
            ->with(['category', 'region'])
            ->whereIn('id', $ids)
            ->get();
    }
}
