<?php

/*
 * This file is part of Laravel Navigation.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Navigation;

use Illuminate\Support\ServiceProvider;

/**
 * This is the navigation service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'navigation');
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
        $this->app->singleton('navigation', function ($app) {
            $request = $app['request'];
            $events = $app['events'];
            $url = $app['url'];
            $view = $app['view'];
            $name = 'navigation::bootstrap';

            $navigation = new Navigation($request, $events, $url, $view, $name);
            $app->refresh('request', $navigation, 'setRequest');

            return $navigation;
        });

        $this->app->alias('navigation', Navigation::class);
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
