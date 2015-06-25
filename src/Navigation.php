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

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

/**
 * This is the navigation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Navigation
{
    /**
     * The items in the main nav bar.
     *
     * @var array
     */
    protected $main = [];

    /**
     * The items in the bar nav bar.
     *
     * @var array
     */
    protected $bar = [];

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The events instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * The url instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The view instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * The view name.
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Http\Request                   $request
     * @param \Illuminate\Contracts\Events\Dispatcher    $events
     * @param \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param \Illuminate\Contracts\View\Factory         $view
     * @param string                                     $name
     *
     * @return void
     */
    public function __construct(Request $request, Dispatcher $events, UrlGenerator $url, Factory $view, $name)
    {
        $this->request = $request;
        $this->events = $events;
        $this->url = $url;
        $this->view = $view;
        $this->name = $name;
    }

    /**
     * Add an item to the main navigation array.
     *
     * @param array  $item
     * @param string $name
     * @param bool   $first
     *
     * @return $this
     */
    public function addToMain(array $item, $name = 'default', $first = false)
    {
        // check if the name exists in the main array
        if (!array_key_exists($name, $this->main)) {
            // add it if it doesn't exists
            $this->main[$name] = [];
        }

        // check if we are forcing the item to the start
        if ($first) {
            // add the item to the start of the array
            $this->main[$name] = array_merge([$item], $this->main[$name]);
        } else {
            // add the item to the end of the array
            $this->main[$name][] = $item;
        }

        return $this;
    }

    /**
     * Add an item to the bar navigation array.
     *
     * @param array  $item
     * @param string $name
     * @param bool   $first
     *
     * @return $this
     */
    public function addToBar(array $item, $name = 'default', $first = false)
    {
        // check if the name exists in the bar array
        if (!array_key_exists($name, $this->bar)) {
            // add it if it doesn't exists
            $this->bar[$name] = [];
        }

        // check if we are forcing the item to the start
        if ($first) {
            // add the item to the start of the array
            $this->bar[$name] = array_merge([$item], $this->bar[$name]);
        } else {
            // add the item to the end of the array
            $this->bar[$name][] = $item;
        }

        return $this;
    }

    /**
     * Get the navigation bar html.
     *
     * @param string      $mainName
     * @param string|bool $barName
     * @param array|null  $data
     *
     * @return string
     */
    public function render($mainName = 'default', $barName = false, array $data = null)
    {
        // set the default value if nothing was passed
        if ($data === null) {
            $data = ['title' => 'Navigation', 'side' => 'dropdown', 'inverse' => true];
        }

        // get the nav bar arrays
        $main = $this->getMain($mainName);
        if (is_string($barName)) {
            $bar = $this->getBar($barName);
            if (empty($bar)) {
                $bar = false;
            }
        } else {
            $bar = false;
        }

        // return the html nav bar
        return $this->view->make($this->name, array_merge($data, ['main' => $main, 'bar' => $bar]))->render();
    }

    /**
     * Get the main navigation array.
     *
     * @param string $name
     *
     * @return array
     */
    protected function getMain($name = 'default')
    {
        // fire event that can be hooked to add items to the nav bar
        $this->events->fire('navigation.main', [['name' => $name]]);

        // check if the name exists in the main array
        if ($name !== 'default' && !array_key_exists($name, $this->main)) {
            // use the default name
            $name = 'default';
        }

        if (!array_key_exists($name, $this->main)) {
            // add it if it doesn't exists
            $this->main[$name] = [];
        }

        // apply active keys
        $nav = $this->active($this->main[$name]);

        // fix up and spit out the nav bar
        return $this->process($nav);
    }

    /**
     * Get the bar navigation array.
     *
     * @param string $name
     *
     * @return array
     */
    protected function getBar($name = 'default')
    {
        // fire event that can be hooked to add items to the nav bar
        $this->events->fire('navigation.bar', [['name' => $name]]);

        // check if the name exists in the bar array
        if ($name !== 'default' && !array_key_exists($name, $this->bar)) {
            // use the default name
            $name = 'default';
        }

        if (!array_key_exists($name, $this->bar)) {
            // add it if it doesn't exists
            $this->bar[$name] = [];
        }

        // don't apply active keys
        $nav = $this->bar[$name];

        // fix up and spit out the nav bar
        return $this->process($nav);
    }

    /**
     * Check if each item is active.
     *
     * @param array $nav
     *
     * @return array
     */
    protected function active(array $nav)
    {
        // check if each item is active
        foreach ($nav as $key => $value) {
            // check if it is local
            if (isset($value['slug'])) {
                // if the request starts with the slug
                if ($this->request->is($value['slug']) || $this->request->is($value['slug'].'/*')) {
                    // then the navigation item is active, or selected
                    $nav[$key]['active'] = true;
                } else {
                    // then the navigation item is not active or selected
                    $nav[$key]['active'] = false;
                }
            } else {
                // then the navigation item is not active or selected
                $nav[$key]['active'] = false;
            }
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Convert slugs to urls.
     *
     * @param array $nav
     *
     * @return array
     */
    protected function process(array $nav)
    {
        // convert slugs to urls
        foreach ($nav as $key => $value) {
            // if the url is not set
            if (!isset($value['url'])) {
                // set the url based on the slug
                $nav[$key]['url'] = $this->url->to($value['slug']);
            }
            // remove any remaining slugs
            unset($nav[$key]['slug']);
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the request instance.
     *
     * @return \Illuminate\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the request instance.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the events instance.
     *
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Get the url instance.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the view instance.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function getView()
    {
        return $this->view;
    }
}
