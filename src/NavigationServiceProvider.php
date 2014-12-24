<?php

/*
 * This file is part of Laravel Navigation by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Navigation;

use Illuminate\Support\ServiceProvider;

/**
 * This is the navigation service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/LICENSE.md> Apache 2.0
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
