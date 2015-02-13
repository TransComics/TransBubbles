<?php
namespace Transcomics\BingTranslation\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class BingTranslationServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // Register 'bingTranslation' instance container to our BingTranslation object
        $this->app['bingTranslation'] = $this->app->share(function ($app) {
            $clientID = getenv("BING_CLIENT_ID");
            $clientSecret = getenv("BING_CLIENT_SECRET");

            $translator = new \Transcomics\BingTranslation\BingTranslation($clientID, $clientSecret);
            return $translator;
        });
    }
}