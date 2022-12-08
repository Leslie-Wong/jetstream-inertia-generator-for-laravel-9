<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Helpers\TranslationsHelper;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->registerInertia();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerInertia()
    {
        // Inertia::version(fn () => md5_file(public_path('mix-manifest.json')));

        Inertia::share([
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return TranslationsHelper::translations(
                    resource_path('lang/'. app()->getLocale() .'.json')
                );
            },
        ]);
    }
}
