<?php

/*
 * This file is part of Laravel Navigation.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Navigation\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use GrahamCampbell\Tests\Navigation\AbstractTestCase;
use GrahamCampbell\Navigation\Facades\Navigation as NavigationFacade;
use GrahamCampbell\Navigation\Navigation;

/**
 * This is the navigation facade test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class NavigationTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'navigation';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return NavigationFacade::class;
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Navigation::class;
    }
}
