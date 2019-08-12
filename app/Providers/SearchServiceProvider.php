<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function (Application $app) {
            $config = $app->make('config')->get('elasticsearch');
            return ClientBuilder::create()
                ->setHosts($config['hosts'])
                ->setRetries($config['retries'])
                ->build();
        });
    }
}
