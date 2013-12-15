Laravel Navigation
==================


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/Laravel-Navigation/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/Laravel-Navigation.png?branch=master)](https://travis-ci.org/GrahamCampbell/Laravel-Navigation)
[![Latest Version](https://poser.pugx.org/graham-campbell/navigation/v/stable.png)](https://packagist.org/packages/graham-campbell/navigation)
[![Total Downloads](https://poser.pugx.org/graham-campbell/navigation/downloads.png)](https://packagist.org/packages/graham-campbell/navigation)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation/badges/quality-score.png?s=00adc2bf1ad673660b1955e237fbf8ce7979dca2)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/Laravel-Navigation.png)](http://stillmaintained.com/GrahamCampbell/Laravel-Navigation)


## What Is Laravel Navigation?

Laravel Navigation is a navigation bar generator for [Laravel 4.1](http://laravel.com).  

* Laravel Navigation was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* Laravel Navigation relies on my [Laravel HTMLMin](https://github.com/GrahamCampbell/Laravel-HTMLMin) package.  
* Laravel Navigation uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-Navigation) to run tests to check if it's working as it should.  
* Laravel Navigation uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Navigation) to run additional tests and checks.  
* Laravel Navigation uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* Laravel Navigation provides a [change log](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Navigation/releases), and a [wiki](https://github.com/GrahamCampbell/Laravel-Navigation/wiki).  
* Laravel Navigation is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/LICENSE.md).  


## System Requirements

* PHP 5.4.7+ or PHP 5.5+ is required.
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel Navigation.  


## Installation

Please check the system requirements before installing Laravel Navigation.  

To get the latest version of Laravel Navigation, simply require it in your `composer.json` file.

`"graham-campbell/navigation": "dev-master"`

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register the [Laravel HTMLMin](https://github.com/GrahamCampbell/Laravel-HTMLMin) service provider before you attempt to load the Laravel Navigation service provider. Open up `app/config/app.php` and add the following to the `providers` key.

`'GrahamCampbell\HTMLMin\HTMLMinServiceProvider'`

Once Laravel Navigation is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

`'GrahamCampbell\Navigation\NavigationServiceProvider'`

You can register the Navigation facade in the `aliases` key of your `app/config/app.php` file if you like.

`'Navigation' => 'GrahamCampbell\Navigation\Facades\Navigation'`


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/Laravel-Navigation).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork Laravel Navigation:  

    git remote add upstream git://github.com/GrahamCampbell/Laravel-Navigation.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream develop
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  


## Pull Requests

Please submit pull requests against the develop branch.  

* Any pull requests made against the master branch will be closed immediately.  
* If you plan to fix a bug, please create a branch called `fix-`, followed by an appropriate name.  
* If you plan to add a feature, please create a branch called `feature-`, followed by an appropriate name.  
* Please follow PSR-2 standards except namespace declarations should be on the same line as `<?php`.  


## License

Apache License  

Copyright 2013 Graham Campbell  

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at  

 http://www.apache.org/licenses/LICENSE-2.0  

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.  
