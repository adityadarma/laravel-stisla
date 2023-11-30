<?php

namespace AdityaDarma\LaravelStisla;

use AdityaDarma\LaravelStisla\Console\LaravelStislaInstall;
use Illuminate\Support\ServiceProvider;

class LaravelStislaServiceProvider extends ServiceProvider
{
    /**
     * Publish data.
     *
     * @return void
     */
    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../public' => public_path('assets')
        ], 'assets');

        $this->publishes([
            __DIR__ . '/../resource/views' => resource_path('views')
        ], 'views');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publish();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands([LaravelStislaInstall::class]);
    }
}
