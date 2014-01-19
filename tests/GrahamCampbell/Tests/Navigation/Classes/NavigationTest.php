<?php

/**
 * This file is part of Laravel Navigation by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Navigation\Classes;

use Mockery;
use GrahamCampbell\Navigation\Classes\Navigation;
use GrahamCampbell\TestBench\Classes\AbstractTestCase;

/**
 * This is the navigation class test class.
 *
 * @package    Laravel-Navigation
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Navigation/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Navigation
 */
class NavigationTest extends AbstractTestCase
{
    public function testGetMainDefault()
    {
        $navigation = $this->getNavigation();

        $navigation->addMain(array('title' => 'Test', 'slug' => 'test'), 'default', false);
        $navigation->addMain(array('title' => 'Next', 'slug' => 'next'), 'default', true);
        $navigation->addMain(array('title' => 'Laravel', 'url' => 'http://laravel.com/url'));

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', array(array('type' => 'default')));

        $navigation->getRequest()->shouldReceive('is')->times(3)
            ->andReturn(true, false);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $navigation->getMain();

        $expected = array(
            array('title' => 'Next', 'url' => 'http://laravel.com/next', 'active' => true),
            array('title' => 'Test', 'url' => 'http://laravel.com/test', 'active' => false),
            array('title' => 'Laravel', 'url' => 'http://laravel.com/url', 'active' => false),
        );

        $this->assertEquals($expected, $return);
    }

    protected function getNavigation()
    {
        $events = Mockery::mock('Illuminate\Events\Dispatcher');
        $request = Mockery::mock('Illuminate\Http\Request');
        $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
        $config = Mockery::mock('Illuminate\Config\Repository');
        $htmlmin = Mockery::mock('GrahamCampbell\HTMLMin\Classes\HTMLMin');

        return new Navigation($events, $request, $url, $config, $htmlmin);
    }
}
