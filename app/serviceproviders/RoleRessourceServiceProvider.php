<?php

namespace Transcomics\RoleRessource\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class RoleRessourceServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // Register 'roleRessource' instance container to our RoleRessource object
        $this->app['roleRessource'] = $this->app->share(function ($app) {

            $roleRessource = new \Transcomics\RoleRessource\RoleRessource();
            return $roleRessource;
        });
    }

}
