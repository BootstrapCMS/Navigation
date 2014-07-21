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

There is currently no usage documentation besides the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Navigation.

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
