<?php


namespace Tests\Features\Admin;

require_once(dirname(__FILE__) . '/../../DatabaseTestCase.php');
require_once(dirname(__FILE__) . '/../../functions.php');
use Tests\DatabaseTestCase;
use RedBean_Facade as R;

class AdminTest extends DatabaseTestCase {
    protected function setUp()
    {
        parent::setUp();
        $this->migrate();

        /** $http Mock Http object. */
        $http = $this->getMock('Skully\Core\Http');
        $http->expects($this->any())
            ->method('redirect')
            ->will($this->returnCallback('stubRedirect'));
        $this->app->setHttp($http);
    }

    public function testRedirectToLogin()
    {
        ob_start();
        $controller = $this->app->runControllerFromRawUrl('admin/');
        $message = ob_get_clean();
        $loginPage = $this->app->config('baseUrl').'admin/login';
        $this->assertTrue(strpos($message, 'redirect to '.$loginPage."\n") !== false);
        $controller = $this->app->runControllerFromRawUrl('admin/login');
    }

}
 