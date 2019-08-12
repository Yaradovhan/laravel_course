<?php

namespace App\Console\Commands\Search;

use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;

class InitCommand extends Command
{

    protected $signature = 'search:init';

    protected $description = 'Command description';

    private $client;

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    public function handle()
    {
        $searchParams = [
            "index" => "test",
            "type" => "test_type",
            'client' => [
                'verbose' => true
            ]
        ];

        try {
            $docs = $this->client->search($searchParams);
            print_r($docs);
        }
        catch
            (Missing404Exception $e) {
                $last = $this->client->transport->getLastConnection()->getLastRequestInfo();
                $last['response']['error'] = [];
                print_r($last);
            }

//        try {
//            $this->client->indices()->delete([
//                'index' => 'app'
//            ]);
//        } catch (Missing404Exception $e) {
//        }
//
//        $this->client->indices()->create([
//            'index' => 'app',
//            'body' => [
//                'mapping' => [
//                    'adverts' => [
//                        'source' => [
//                            '_enabled' => true
//                        ],
//                        'properties' => [
//                            'id' => [
//                                'type' => 'integer',
//                            ],
//                            'published_at' => [
//                                'type' => 'date',
//                            ],
//                            'title' => [
//                                'type' => 'text',
//                            ],
//                            'content' => [
//                                'type' => 'text',
//                            ],
//                            'price' => [
//                                'type' => 'integer',
//                            ],
//                            'status' => [
//                                'type' => 'keyword',
//                            ],
//                            'categories' => [
//                                'type' => 'integer',
//                            ],
//                            'regions' => [
//                                'type' => 'integer',
//                            ],
//                            'values' => [
//                                'type' => 'nested',
//                                'properties' => [
//                                    'attribute' => [
//                                        'type' => 'integer'
//                                    ],
//                                    'value_string' => [
//                                        'type' => 'keyword',
//                                    ],
//                                    'value_int' => [
//                                        'type' => 'integer',
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ]
//                ]
//            ],
//        ]);
//
//        return true;
    }
}
