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
            'languages' => function () {
                $langs = json_encode(glob(resource_path('lang/*.json')));
                $p = str_replace('"',"",json_encode(resource_path('lang/')));
                $langs = str_replace($p,"",$langs);
                $langs = str_replace(".json","",$langs);

                return json_decode($langs);
            },
            'language' => function () {
                return TranslationsHelper::translations(
                    resource_path('lang/'. app()->getLocale() .'.json')
                );
            },
        ]);
    }
}
