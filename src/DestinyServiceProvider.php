<?php


namespace Maturest\Trigram;

use Illuminate\Support\ServiceProvider;

class DestinyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/' => public_path(),
        ]);
    }
}