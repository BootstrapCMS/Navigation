Laravel Navigation
==================

Laravel Navigation was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a navigation bar generator for [Laravel 5](http://laravel.com). Feel free to check out the [releases](https://github.com/BootstrapCMS/Navigation/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Navigation](https://cloud.githubusercontent.com/assets/2829600/4432308/c153cd00-468c-11e4-9fc0-4776b482e6ef.PNG)

<p align="center">
<a href="https://travis-ci.org/BootstrapCMS/Navigation"><img src="https://img.shields.io/travis/BootstrapCMS/Navigation/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/Navigation/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/BootstrapCMS/Navigation.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/Navigation"><img src="https://img.shields.io/scrutinizer/g/BootstrapCMS/Navigation.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BootstrapCMS/Navigation/releases"><img src="https://img.shields.io/github/release/BootstrapCMS/Navigation.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Navigation, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/navigation": "~2.1"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Navigation is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Navigation\NavigationServiceProvider'`

You can register the Navigation facade in the `aliases` key of your `config/app.php` file if you like.

* `'Navigation' => 'GrahamCampbell\Navigation\Facades\Navigation'`


## Configuration

Laravel Navigation requires no configuration. Just follow the simple install instructions and go!


## Usage

##### Navigation

This is the class of most interest. It is bound to the ioc container as `'navigation'` and can be accessed using the `Facades\Navigation` facade. There are three public methods of interest.

The `'addToMain'` and `'addToBar'` methods will add the item to the internal main navigation array in the specified way. These methods both accept three arguments. All but the first are optional. The first argument must be an array. It must have either a `'slug'` key or a `'url'` key where the slug is the target url relative to the base url, and the url is a full url you may specify (useful to link to somewhere outside the application). It must also have a `'title'` key which will specify the title, and you may also optionally add an `'icon'` key which will at the relevant icon from font awesome to the mix. The second parameter specifies which navigation bar you want to add to. By default this is `'default'`, but you may have mutliple navigation bars, for example, [Bootstrap CMS](https://github.com/BootstrapCMS/CMS) has an `'admin'` navigation bar. The final parameter specifies if the item should be prepended to the internal array. By default this is `false`.

The third method is `'render'`, and accepts three arguments. All arguments are optional. The fist argument selects the main navigation bar you which to return. By default this is set to `'default'`. The third argument selection the bar navigation bar you wish to return. By default this is set to `false`, where by no bar navigation is returned. You may set this to any string to return the relevant navigation bar. The final parameter is an array of variables you wish to pass to the navigation view. The default is `['title' => 'Navigation', 'side' => 'dropdown', 'inverse' => true]`.

Note that the navigation bar referred to as `'main'` is the navigation bar that will go across the top of your page, and the navigation bar referred to as `'bar'` is the navigation bar that will be a dropdown at the side. These are also referred to in the context of the default view provided with this package (for Twitter Bootstrap 3).

Also note that the render method will emit events so you can call the addTo methods lazily. The events emitted are `'navigation.main'` and `'navigation.bar'`, which are emitted just before the render method starts to deal with the each navigation bar. The name of the selected navigation bar is also emitted. Check out the [source](https://github.com/BootstrapCMS/Navigation/blob/master/src/Navigation.php).

##### Facades\Navigation

This facade will dynamically pass static method calls to the `'navigation'` object in the ioc container which by default is the `Navigation` class.

##### NavigationServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.


## License

Laravel Navigation is licensed under [The MIT License (MIT)](LICENSE).
