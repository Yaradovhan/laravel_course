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
                'from' => ($page - 1) * $perPage,
                'size' => $perPage,
                'query' => [
                    'bool' => [
                        'must' => array_filter([
                            ['term' => ['status' => Advert::STATUS_ACTIVE]],
                            $category ? ['term' => ['categories' => $category->id]] : false,
                            $region ? ['term' => ['region' => $region->id]] : false,
                            !empty($request->text) ? ['multi_match' => [
                                'query' => $request->text,
                                'fields' => ['title^3', 'content']
                            ]] : false
                        ]),
                    ]
                ]
            ]
        ]);

        $ids = array_column($response['hits']['hits'], '_id');

        $items = Advert::active()
            ->with(['category', 'region'])
            ->whereIn('id', $ids)
            ->orderBy('FIELD(id, ' . implode(',', $ids) . ')')
            ->get();
    }
}
