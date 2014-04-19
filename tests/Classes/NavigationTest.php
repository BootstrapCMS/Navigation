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
use Illuminate\Http\Request;
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
    public function testMainDefault()
    {
        $navigation = $this->getNavigation();

        $navigation->addMain(array('title' => 'Test', 'slug' => 'test'), 'default', false);
        $navigation->addMain(array('title' => 'Next', 'slug' => 'next'), 'default', true);
        $navigation->addMain(array('title' => 'Laravel', 'url' => 'http://laravel.com/url'), 'default');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', array(array('type' => 'default')));

        $navigation->getRequest()->shouldReceive('is')->times(3)
            ->andReturn(true, false);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $navigation->getMain('default');

        $expected = array(
            array('title' => 'Next', 'url' => 'http://laravel.com/next', 'active' => true),
            array('title' => 'Test', 'url' => 'http://laravel.com/test', 'active' => false),
            array('title' => 'Laravel', 'url' => 'http://laravel.com/url', 'active' => false)
        );

        $this->assertEquals($expected, $return);
    }

    public function testMainOther()
    {
        $navigation = $this->getNavigation();

        $navigation->addMain(array('title' => 'Test', 'slug' => 'test'), 'other', false);
        $navigation->addMain(array('title' => 'Next', 'slug' => 'next'), 'other', true);
        $navigation->addMain(array('title' => 'Laravel', 'url' => 'http://laravel.com/url'), 'other');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', array(array('type' => 'other')));

        $navigation->getRequest()->shouldReceive('is')->times(3)
            ->andReturn(true, false);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $navigation->getMain('other');

        $expected = array(
            array('title' => 'Next', 'url' => 'http://laravel.com/next', 'active' => true),
            array('title' => 'Test', 'url' => 'http://laravel.com/test', 'active' => false),
            array('title' => 'Laravel', 'url' => 'http://laravel.com/url', 'active' => false)
        );

        $this->assertEquals($expected, $return);
    }

    public function testMainEmpty()
    {
        $navigation = $this->getNavigation();

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', array(array('type' => 'empty')));

        $return = $navigation->getMain('empty');

        $expected = array();

        $this->assertEquals($expected, $return);
    }

    public function testBarDefault()
    {
        $navigation = $this->getNavigation();

        $navigation->addBar(array('title' => 'Test', 'slug' => 'test'), 'default', false);
        $navigation->addBar(array('title' => 'Next', 'slug' => 'next'), 'default', true);
        $navigation->addBar(array('title' => 'Laravel', 'url' => 'http://laravel.com/url'), 'default');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', array(array('type' => 'default')));

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $navigation->getBar('default');

        $expected = array(
            array('title' => 'Next', 'url' => 'http://laravel.com/next'),
            array('title' => 'Test', 'url' => 'http://laravel.com/test'),
            array('title' => 'Laravel', 'url' => 'http://laravel.com/url')
        );

        $this->assertEquals($expected, $return);
    }

    public function testBarOther()
    {
        $navigation = $this->getNavigation();

        $navigation->addBar(array('title' => 'Test', 'slug' => 'test'), 'other', false);
        $navigation->addBar(array('title' => 'Next', 'slug' => 'next'), 'other', true);
        $navigation->addBar(array('title' => 'Laravel', 'url' => 'http://laravel.com/url'), 'other');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', array(array('type' => 'other')));

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $navigation->getBar('other');

        $expected = array(
            array('title' => 'Next', 'url' => 'http://laravel.com/next'),
            array('title' => 'Test', 'url' => 'http://laravel.com/test'),
            array('title' => 'Laravel', 'url' => 'http://laravel.com/url')
        );

        $this->assertEquals($expected, $return);
    }

    public function testBarEmpty()
    {
        $navigation = $this->getNavigation();

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', array(array('type' => 'empty')));

        $return = $navigation->getBar('empty');

        $expected = array();

        $this->assertEquals($expected, $return);
    }

    public function testAddMain()
    {
        $navigation = $this->getNavigation();

        $return = $navigation->addMain(array('title' => 'Test', 'slug' => 'test'));

        $this->assertEquals($navigation, $return);
    }

    public function testAddBar()
    {
        $navigation = $this->getNavigation();

        $return = $navigation->addBar(array('title' => 'Test', 'slug' => 'test'));

        $this->assertEquals($navigation, $return);
    }

    public function testGetHTMLNoBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn(array(array('title' => 'Test', 'url' => 'http://laravel.com/test')));

        $data = array(
            'title' => 'Navigation',
            'side' => 'dropdown',
            'inverse' => true,
            'main' => array(array('title' => 'Test', 'url' => 'http://laravel.com/test')),
            'bar' => false
        );

        $navigation->getHTMLMin()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn('html goes here');

        $return = $navigation->getHTML('default', false);

        $this->assertEquals($return, 'html goes here');
    }

    public function testGetHTMLEmptyBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn(array(array('title' => 'Test', 'url' => 'http://laravel.com/test')));

        $navigation->shouldReceive('getBar')->once()->with('default')->andReturn(array());

        $data = array(
            'title' => 'Navigation',
            'side' => 'dropdown',
            'inverse' => true,
            'main' => array(array('title' => 'Test', 'url' => 'http://laravel.com/test')),
            'bar' => array()
        );

        $navigation->getHTMLMin()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn('html goes here');

        $return = $navigation->getHTML('default', 'default');

        $this->assertEquals($return, 'html goes here');
    }

    public function testGetHTMLWithBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn(array(array('title' => 'Test', 'url' => 'http://laravel.com/test')));

        $navigation->shouldReceive('getBar')->once()->with('default')
            ->andReturn(array(array('title' => 'Test', 'url' => 'http://laravel.com/test')));

        $data = array(
            'title' => 'Navigation',
            'side' => 'dropdown',
            'inverse' => true,
            'main' => array(array('title' => 'Test', 'url' => 'http://laravel.com/test')),
            'bar' => array(array('title' => 'Test', 'url' => 'http://laravel.com/test'))
        );

        $navigation->getHTMLMin()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn('html goes here');

        $return = $navigation->getHTML('default', 'default');

        $this->assertEquals($return, 'html goes here');
    }

    public function testSetRequest()
    {
        $navigation = $this->getNavigation()();

        $request = new Request();

        $navigation->setRequest($request);

        $return = $navigation->getRequest();

        $this->assertEquals($request, $return);
    }

    protected function getNavigation()
    {
        $events = Mockery::mock('Illuminate\Events\Dispatcher');
        $request = Mockery::mock('Illuminate\Http\Request');
        $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
        $htmlmin = Mockery::mock('GrahamCampbell\HTMLMin\Classes\HTMLMin');

        return new Navigation($events, $request, $url, $htmlmin, 'view');
    }

    protected function getMockedNavigation()
    {
        $events = Mockery::mock('Illuminate\Events\Dispatcher');
        $request = Mockery::mock('Illuminate\Http\Request');
        $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
        $htmlmin = Mockery::mock('GrahamCampbell\HTMLMin\Classes\HTMLMin');

        $params = array($events, $request, $url, $htmlmin, 'view');

        return Mockery::mock('GrahamCampbell\Navigation\Classes\Navigation[getMain,getBar]', $params);
    }
}
