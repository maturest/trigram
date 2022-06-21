<?php


namespace Maturest\Trigram;

use Illuminate\Support\ServiceProvider;
use Maturest\ChineseCalendar\Calendar;

class DestinyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/' => public_path(),
        ]);
    }

    public function register()
    {
        $this->app->singleton(Calendar::class, function ($app) {
            return new Calendar();
        });

        $this->app->alias(Calendar::class,'calendar');
    }

    public function provides()
    {
        return [Calendar::class,'calendar'];
    }
}