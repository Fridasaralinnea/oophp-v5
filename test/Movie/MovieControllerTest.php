<?php

namespace Fla\Movie;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class MovieControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new MovieController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }



    /**
     * Call the controller debug action.
     */
    public function testDebugAction()
    {
        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertContains("Debug movie!!", $res);
    }



    /**
     * Call the controller searchTitle action GET.
     */
    public function testSearchTitleActionGet()
    {
        $res = $this->controller->searchTitleActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller searchTitle action POST.
     */
    public function testSearchTitleActionPost()
    {
        $res = $this->controller->searchTitleActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller searchYear action GET.
     */
    public function testSearchYearActionGet()
    {
        $res = $this->controller->searchYearActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller searchYear action POST.
     */
    public function testSearchYearActionPost()
    {
        $res = $this->controller->searchYearActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller add action GET.
     */
    public function testAddActionGet()
    {
        $res = $this->controller->addActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
