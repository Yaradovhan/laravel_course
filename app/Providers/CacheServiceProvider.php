<?php

namespace App\Providers;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    private $classes = [
        Region::class,
        Category::class
    ];

    public function register()
    {

    }

    public function boot()
    {
        foreach ($this->classes as $class) {
            $this->registerFlush($class);
        }
    }

    public function registerFlush($class): void
    {
        $flush = function () use ($class) {
            Cache::tags($class)->flush();
        };
        /**
         * @var Model $class
         */
        $class::created($flush);
        $class::saved($flush);
        $class::updated($flush);
        $class::deleted($flush);
    }
}
