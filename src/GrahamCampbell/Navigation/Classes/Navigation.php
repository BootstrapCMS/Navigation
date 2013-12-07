<?php namespace GrahamCampbell\Navigation\Classes;

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
 *
 * @package    Laravel-Navigation
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-Navigation
 */

use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Config\Repository;
use GrahamCampbell\HTMLMin\Classes\HTMLMin;

class Navigation {

    /**
     * The items in the main nav bar.
     *
     * @var array
     */
    protected $main = array();

    /**
     * The items in the bar nav bar.
     *
     * @var array
     */
    protected $bar = array();

    /**
     * The events instance.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The url instance.
     *
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The config instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The htmlmin instance.
     *
     * @var \GrahamCampbell\HTMLMin\Classes\HTMLMin
     */
    protected $htmlmin;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Illuminate\Config\Repository  $config
     * @param  \GrahamCampbell\HTMLMin\Classes\HTMLMin  $htmlmin
     * @return void
     */
    public function __construct(Dispatcher $events, Request $request, UrlGenerator $url, Repository $config, HTMLMin $htmlmin) {
        $this->events = $events;
        $this->request = $request;
        $this->url = $url;
        $this->config = $config;
        $this->htmlmin = $htmlmin;
    }

    public function getMain($type = 'default') {
        // fire event that can be hooked to add items to the nav bar
        $this->events->fire('navigation.main', array(array('type' => $type)));

        // check if the type exists in the main array
        if ($type !== 'default' && !array_key_exists($type, $this->main)) {
            // use the default type
            $type = 'default';
        }

        if (!array_key_exists($type, $this->main)) {
            // add it if it doesn't exists
            $this->main[$type] = array();
        }

        // apply active keys
        $nav = $this->active($this->main[$type]);

        // fix up and spit out the nav bar
        return $this->process($nav);
    }

    public function getBar($type = 'default') {
        // fire event that can be hooked to add items to the nav bar
        $this->events->fire('navigation.bar', array(array('type' => $type)));

        // check if the type exists in the bar array
        if ($type !== 'default' && !array_key_exists($type, $this->bar)) {
            // use the default type
            $type = 'default';
        }

        if (!array_key_exists($type, $this->bar)) {
            // add it if it doesn't exists
            $this->bar[$type] = array();
        }

        // don't apply active keys
        $nav = $this->bar[$type];

        // fix up and spit out the nav bar
        return $this->process($nav);
    }

    public function addMain($type = 'default', array $item, $first = false) {
        // check if the type exists in the main array
        if (!array_key_exists($type, $this->main)) {
            // add it if it doesn't exists
            $this->main[$type] = array();
        }

        // check if we are forcing the item to the start
        if ($first) {
            // add the item to the start of the array
            $this->main[$type] = array_merge($this->main[$type], array($item));
        } else {
            // add the item to the end of the array
            $this->main[$type][] = $item;
        }
    }

    public function addBar($type = 'default', array $item, $first = false) {
        // check if the type exists in the bar array
        if (!array_key_exists($type, $this->bar)) {
            // add it if it doesn't exists
            $this->bar[$type] = array();
        }

        // check if we are forcing the item to the start
        if ($first) {
            // add the item to the start of the array
            $this->bar[$type] = array_merge($this->bar[$type], array($item));
        } else {
            // add the item to the end of the array
            $this->bar[$type][] = $item;
        }
    }

    public function getHTML($maintype = 'default', $bartype = 'default', array $data = array('title' => 'Navigation', 'side' => 'dropdown', 'inverse' => true)) {
        // get the nav bar arrays
        $mainnav = $this->getMain($maintype);
        if ($bartype) {
            $barnav = $this->getMain($bartype);
        } else {
            $barnav = false;
        }

        // return the html nav bar
        return $this->htmlmin->make($this->config['navigation::view'], array_merge($data, array('main' => $mainnav, 'bar' => $barnav)));
    }

    protected function active(array $nav) {
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

    protected function process(array $nav) {
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
}
