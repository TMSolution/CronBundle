<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TMSolution\CronBundle\Tests\Controller;

use TMSolution\TestingBundle\Functional\AppTestCase;
use TMSolution\TestingBundle\Functional\Url;

/**
 * Functional test for TMSolution\CronBundle\Controller\DefaultController 
 */
class DefaultControllerTest extends AppTestCase
{
    /**
     * Function test for TMSolution\CronBundle\Controller\DefaultController::indexAction
     *
     * @Url("/hello/{name}")
     */
    public function testIndexAction()
    {
        $this->assertTrue(true);
    }
    
}
