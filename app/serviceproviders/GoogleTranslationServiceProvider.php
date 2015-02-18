<?php
namespace Transcomics\GoogleTranslation\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class GoogleTranslationServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // Register 'googleTranslation' instance container to our GoogleTranslation object
        $this->app['googleTranslation'] = $this->app->share(function ($app) {
            
            $translator = new \Transcomics\GoogleTranslation\GoogleTranslation();
            return $translator;
        });
    }
}