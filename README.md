Laravel Navigation
==================


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Navigation/master.svg?style=flat)](https://travis-ci.org/GrahamCampbell/Laravel-Navigation)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Navigation.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Navigation.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Navigation.svg?style=flat)](https://github.com/GrahamCampbell/Laravel-Navigation/releases)


## Introduction

Laravel Navigation was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a navigation bar generator for [Laravel 4.2+](http://laravel.com). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Navigation/releases), [license](LICENSE.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.2+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Navigation, simply require `"graham-campbell/navigation": "~1.0"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Navigation is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Navigation\NavigationServiceProvider'`

You can register the Navigation facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'Navigation' => 'GrahamCampbell\Navigation\Facades\Navigation'`


## Configuration

Laravel Navigation requires no configuration. Just follow the simple install instructions and go!


## Usage

##### Navigation

This is the class of most interest. It is bound to the ioc container as `'navigation'` and can be accessed using the `Facades\Navigation` facade. There are three public methods of interest.

The `'addToMain'` and `'addToBar'` methods will add the item to the internal main navigation array in the specified way. These methods both accept three arguments. All but the first are optional. The first argument must be an array. It must have either a `'slug'` key or a `'url'` key where the slug is the target url relative to the base url, and the url is a full url you may specify (useful to link to somewhere outside the application). It must also have a `'title'` key which will specify the title, and you may also optionally add an `'icon'` key which will at the relevant icon from font awesome to the mix. The second parameter specifies which navigation bar you want to add to. By default this is `'default'`, but you may have mutliple navigation bars, for example, [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS) has an `'admin'` navigation bar. The final parameter specifies if the item should be prepended to the internal array. By default this is `false`.

The third method is `'render'`, and accepts three arguments. All arguments are optional. The fist argument selects the main navigation bar you which to return. By default this is set to `'default'`. The third argument selection the bar navigation bar you wish to return. By default this is set to `false`, where by no bar navigation is returned. You may set this to any string to return the relevant navigation bar. The final parameter is an array of variables you wish to pass to the navigation view. The default is `array('title' => 'Navigation', 'side' => 'dropdown', 'inverse' => true)`.

Note that the navigation bar referred to as `'main'` is the navigation bar that will go across the top of your page, and the navigation bar referred to as `'bar'` is the navigation bar that will be a dropdown at the side. These are also referred to in the context of the default view provided with this package (for Twitter Bootstrap 3).

Also note that the render method will emit events so you can call the addTo methods lazily. The events emitted are `'navigation.main'` and `'navigation.bar'`, which are emitted just before the render method starts to deal with the each navigation bar. The name of the selected navigation bar is also emitted. Check out the [source](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/src/Navigation.php).

##### Facades\Navigation

This facade will dynamically pass static method calls to the `'navigation'` object in the ioc container which by default is the `Navigation` class.

##### NavigationServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `app/config/app.php`. This class will setup ioc bindings.

##### Further Information

Feel free to check out the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Navigation.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## License

Apache License

Copyright 2013-2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
