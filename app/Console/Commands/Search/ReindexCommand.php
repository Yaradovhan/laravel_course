<?php

namespace App\Console\Commands\Search;

use Illuminate\Console\Command;
use App\Entity\Adverts\Advert\Advert;
use App\Services\Search\AdvertIndexer;

class ReindexCommand extends Command
{

    protected $signature = 'search:reindex';

    protected $description = 'Command description';

    private $indexer;

    public function __construct(AdvertIndexer $indexer)
    {
        parent::__construct();
        $this->indexer = $indexer;
    }

    public function handle(): bool
    {
        $this->indexer->clear();

        foreach (Advert::active()->orderBy('id')->cursor() as $advert) {
            $this->indexer->index($advert);
        }
        return true;
    }

}