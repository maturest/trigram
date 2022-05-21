<?php


namespace Maturest\Trigram;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Overtrue\ChineseCalendar\Calendar;

class DestinyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/' => public_path(),
        ]);
    }

    public function provides()
    {
        return [Calendar::class];
    }

    public function register()
    {
        $this->app->singleton(Calendar::class, function ($app) {
            return new Calendar();
        });

        $this->app->alias(Calendar::class,'calendar');
    }
}