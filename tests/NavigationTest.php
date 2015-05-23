<?php

/*
 * This file is part of Laravel Navigation.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Navigation;

use GrahamCampbell\Navigation\Navigation;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Http\Request;
use Mockery;
use ReflectionClass;

/**
 * This is the navigation class test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class NavigationTest extends AbstractTestBenchTestCase
{
    public function testMainDefault()
    {
        $navigation = $this->getNavigation();

        $navigation->addToMain(['title' => 'Test', 'slug' => 'test'], 'default', false);
        $navigation->addToMain(['title' => 'Next', 'slug' => 'next'], 'default', true);
        $navigation->addToMain(['title' => 'Laravel', 'url' => 'http://laravel.com/url'], 'default');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', [['name' => 'default']]);

        $navigation->getRequest()->shouldReceive('is')->times(3)
            ->andReturn(true, false);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $this->callProtected($navigation, 'getMain', ['default']);

        $expected = [
            ['title' => 'Next', 'active' => true, 'url' => 'http://laravel.com/next'],
            ['title' => 'Test', 'active' => false, 'url' => 'http://laravel.com/test'],
            ['title' => 'Laravel', 'url' => 'http://laravel.com/url', 'active' => false],
        ];

        $this->assertSame($expected, $return);
    }

    public function testMainOther()
    {
        $navigation = $this->getNavigation();

        $navigation->addToMain(['title' => 'Test', 'slug' => 'test'], 'other', false);
        $navigation->addToMain(['title' => 'Next', 'slug' => 'next'], 'other', true);
        $navigation->addToMain(['title' => 'Laravel', 'url' => 'http://laravel.com/url'], 'other');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', [['name' => 'other']]);

        $navigation->getRequest()->shouldReceive('is')->times(3)
            ->andReturn(true, false);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $this->callProtected($navigation, 'getMain', ['other']);

        $expected = [
            ['title' => 'Next', 'active' => true, 'url' => 'http://laravel.com/next'],
            ['title' => 'Test', 'active' => false, 'url' => 'http://laravel.com/test'],
            ['title' => 'Laravel', 'url' => 'http://laravel.com/url', 'active' => false],
        ];

        $this->assertSame($expected, $return);
    }

    public function testMainEmpty()
    {
        $navigation = $this->getNavigation();

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.main', [['name' => 'empty']]);

        $return = $this->callProtected($navigation, 'getMain', ['empty']);

        $expected = [];

        $this->assertSame($expected, $return);
    }

    public function testBarDefault()
    {
        $navigation = $this->getNavigation();

        $navigation->addToBar(['title' => 'Test', 'slug' => 'test'], 'default', false);
        $navigation->addToBar(['title' => 'Next', 'slug' => 'next'], 'default', true);
        $navigation->addToBar(['title' => 'Laravel', 'url' => 'http://laravel.com/url'], 'default');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', [['name' => 'default']]);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $this->callProtected($navigation, 'getBar', ['default']);

        $expected = [
            ['title' => 'Next', 'url' => 'http://laravel.com/next'],
            ['title' => 'Test', 'url' => 'http://laravel.com/test'],
            ['title' => 'Laravel', 'url' => 'http://laravel.com/url'],
        ];

        $this->assertSame($expected, $return);
    }

    public function testBarOther()
    {
        $navigation = $this->getNavigation();

        $navigation->addToBar(['title' => 'Test', 'slug' => 'test'], 'other', false);
        $navigation->addToBar(['title' => 'Next', 'slug' => 'next'], 'other', true);
        $navigation->addToBar(['title' => 'Laravel', 'url' => 'http://laravel.com/url'], 'other');

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', [['name' => 'other']]);

        $navigation->getUrl()->shouldReceive('to')->twice()
            ->andReturn('http://laravel.com/next', 'http://laravel.com/test');

        $return = $this->callProtected($navigation, 'getBar', ['other']);

        $expected = [
            ['title' => 'Next', 'url' => 'http://laravel.com/next'],
            ['title' => 'Test', 'url' => 'http://laravel.com/test'],
            ['title' => 'Laravel', 'url' => 'http://laravel.com/url'],
        ];

        $this->assertSame($expected, $return);
    }

    public function testBarEmpty()
    {
        $navigation = $this->getNavigation();

        $navigation->getEvents()->shouldReceive('fire')->once()
            ->with('navigation.bar', [['name' => 'empty']]);

        $return = $this->callProtected($navigation, 'getBar', ['empty']);

        $expected = [];

        $this->assertSame($expected, $return);
    }

    public function testAddToMain()
    {
        $navigation = $this->getNavigation();

        $return = $navigation->addToMain(['title' => 'Test', 'slug' => 'test']);

        $this->assertSame($navigation, $return);
    }

    public function testAddToBar()
    {
        $navigation = $this->getNavigation();

        $return = $navigation->addToBar(['title' => 'Test', 'slug' => 'test']);

        $this->assertSame($navigation, $return);
    }

    public function testGetHTMLNoBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn([['title' => 'Test', 'url' => 'http://laravel.com/test']]);

        $data = [
            'title'   => 'Navigation',
            'side'    => 'dropdown',
            'inverse' => true,
            'main'    => [['title' => 'Test', 'url' => 'http://laravel.com/test']],
            'bar'     => false,
        ];

        $navigation->getView()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn($this->getMockedView());

        $return = $navigation->render('default', false);

        $this->assertSame('html goes here', $return);
    }

    public function testGetHTMLEmptyBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn([['title' => 'Test', 'url' => 'http://laravel.com/test']]);

        $navigation->shouldReceive('getBar')->once()->with('default')->andReturn([]);

        $data = [
            'title'   => 'Navigation',
            'side'    => 'dropdown',
            'inverse' => true,
            'main'    => [['title' => 'Test', 'url' => 'http://laravel.com/test']],
            'bar'     => [],
        ];

        $navigation->getView()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn($this->getMockedView());

        $return = $navigation->render('default', 'default');

        $this->assertSame('html goes here', $return);
    }

    public function testGetHTMLWithBar()
    {
        $navigation = $this->getMockedNavigation();

        $navigation->shouldReceive('getMain')->once()->with('default')
            ->andReturn([['title' => 'Test', 'url' => 'http://laravel.com/test']]);

        $navigation->shouldReceive('getBar')->once()->with('default')
            ->andReturn([['title' => 'Test', 'url' => 'http://laravel.com/test']]);

        $data = [
            'title'   => 'Navigation',
            'side'    => 'dropdown',
            'inverse' => true,
            'main'    => [['title' => 'Test', 'url' => 'http://laravel.com/test']],
            'bar'     => [['title' => 'Test', 'url' => 'http://laravel.com/test']],
        ];

        $navigation->getView()->shouldReceive('make')->once()
            ->with('view', $data)->andReturn($this->getMockedView());

        $return = $navigation->render('default', 'default');

        $this->assertSame('html goes here', $return);
    }

    public function testSetRequest()
    {
        $navigation = $this->getNavigation();

        $request = new Request();

        $navigation->setRequest($request);

        $return = $navigation->getRequest();

        $this->assertSame($request, $return);
    }

    protected function getNavigation()
    {
        $request = Mockery::mock('Illuminate\Http\Request');
        $events = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');
        $url = Mockery::mock('Illuminate\Contracts\Routing\UrlGenerator');
        $view = Mockery::mock('Illuminate\Contracts\View\Factory');

        return new Navigation($request, $events, $url, $view, 'view');
    }

    protected function getMockedNavigation()
    {
        $request = Mockery::mock('Illuminate\Http\Request');
        $events = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');
        $url = Mockery::mock('Illuminate\Contracts\Routing\UrlGenerator');
        $view = Mockery::mock('Illuminate\Contracts\View\Factory');

        $params = [$request, $events, $url, $view, 'view'];

        return Mockery::mock('GrahamCampbell\Navigation\Navigation[getMain,getBar]', $params)
            ->shouldAllowMockingProtectedMethods();
    }

    protected function getMockedView()
    {
        $view = Mockery::mock('Illuminate\Contracts\View\View');

        $view->shouldReceive('render')->once()->andReturn('html goes here');

        return $view;
    }

    protected function callProtected($object, $name, array $args = [])
    {
        $reflection = new ReflectionClass($object);

        $method = $reflection->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
