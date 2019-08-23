<?php

namespace App\Console\Commands\Advert;

use App\Entity\Adverts\Advert\Advert;
use App\UseCases\Adverts\AdvertService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EpireCommand extends Command
{
    protected $signature = 'advert:expire';
    protected $description = 'Expire adverts';
    private $service;

    public function __construct(AdvertService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $success = true;

        foreach (Advert::active()->where('expired_at', '<', Carbon::now())->cursor() as $advert) {
            try {
                $this->service->expire($advert);
            } catch (\DomainException $e) {
                $this->error($e->getMessage());
                $success = false;
            }
        }

        return $success;
    }
}
