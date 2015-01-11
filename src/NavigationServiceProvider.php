<?php

/*
 * This file is part of Laravel Navigation.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Navigation;

use Illuminate\Support\ServiceProvider;

/**
 * This is the navigation service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/navigation', 'graham-campbell/navigation', __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNavigation();
    }

    /**
     * Register the navigation class.
     *
     * @return void
     */
    protected function registerNavigation()
    {
        $this->app->bindShared('navigation', function ($app) {
            $events = $app['events'];
            $request = $app['request'];
            $url = $app['url'];
            $view = $app['view'];
            $name = 'graham-campbell/navigation::bootstrap';

            $navigation = new Navigation($events, $request, $url, $view, $name);
            $app->refresh('request', $navigation, 'setRequest');

            return $navigation;
        });

        $this->app->alias('navigation', 'GrahamCampbell\Navigation\Navigation');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'navigation',
        ];
    }
}
