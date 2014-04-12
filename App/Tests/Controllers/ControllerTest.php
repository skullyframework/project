<?php


namespace Tests\Controllers;

require_once __DIR__.'/../../bootstrap.php';

class ControllerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \App\Application
     */
    protected $app;
    protected function setUp()
    {
        $_SERVER["SERVER_NAME"] = 'localhost';
        $this->app = __setupApp();
        if (empty($_GET['_url'])) {
            $_GET['_url'] = '';
        }
    }
}
 