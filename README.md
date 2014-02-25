Laravel Navigation
==================


[![Build Status](https://travis-ci.org/GrahamCampbell/Laravel-Navigation.png)](https://travis-ci.org/GrahamCampbell/Laravel-Navigation)
[![Coverage Status](https://coveralls.io/repos/GrahamCampbell/Laravel-Navigation/badge.png)](https://coveralls.io/r/GrahamCampbell/Laravel-Navigation)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation/badges/quality-score.png?s=00adc2bf1ad673660b1955e237fbf8ce7979dca2)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/abdd3547-d882-4b7d-8ed4-3e01bb1967c5/mini.png)](https://insight.sensiolabs.com/projects/abdd3547-d882-4b7d-8ed4-3e01bb1967c5)
[![Software License](https://poser.pugx.org/graham-campbell/navigation/license.png)](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/LICENSE.md)
[![Latest Version](https://poser.pugx.org/graham-campbell/navigation/v/stable.png)](https://packagist.org/packages/graham-campbell/navigation)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/Laravel-Navigation.png)](http://stillmaintained.com/GrahamCampbell/Laravel-Navigation)


## What Is Laravel Navigation?

Laravel Navigation is a navigation bar generator for [Laravel 4.1](http://laravel.com).

* Laravel Navigation was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel Navigation relies on my [Laravel HTMLMin](https://github.com/GrahamCampbell/Laravel-HTMLMin) package.
* Laravel Navigation uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-Navigation) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-Navigation) to check everything is working.
* Laravel Navigation uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/abdd3547-d882-4b7d-8ed4-3e01bb1967c5) to run additional checks.
* Laravel Navigation uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel Navigation provides a [change log](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Navigation/releases), and [api docs](http://grahamcampbell.github.io/Laravel-Navigation).
* Laravel Navigation is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 2.4+ is required.
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel Navigation.


## Installation

Please check the system requirements before installing Laravel Navigation.

To get the latest version of Laravel Navigation, simply require `"graham-campbell/navigation": "0.3.*@dev"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register the [Laravel HTMLMin](https://github.com/GrahamCampbell/Laravel-HTMLMin) service provider before you attempt to load the Laravel Navigation service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\HTMLMin\HTMLMinServiceProvider'`

Once Laravel Navigation is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Navigation\NavigationServiceProvider'`

You can register the Navigation facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'Navigation' => 'GrahamCampbell\Navigation\Facades\Navigation'`


## Configuration

Laravel Navigation supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/navigation

There is one config option:

**Navigation View**

This option (`'view'`) defines the view to use for the navigation bar. The default value for this setting is `'graham-campbell/navigation::bootstrap'`.


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/Laravel-Navigation
) for Laravel Navigation.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel Navigation:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-Navigation.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


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
