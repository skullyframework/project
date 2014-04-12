<?php


namespace Tests\Controllers;

require_once 'ControllerTest.php';

class HomeControllerTest extends ControllerTest {

    public function testSmartyTemplateDir()
    {
        $r = $this->app->getTemplateEngine()->getTemplateDir();
        $this->assertEquals($this->app->config('basePath').'public/default/App/views/', $r['main']);
    }

    public function testSmartyPluginsDir()
    {
        $r = $this->app->getTemplateEngine()->getPluginsDir();
        $this->assertEquals($this->app->config('basePath').'App/smarty/plugins/', $r[0]);
    }
    public function testIndex()
    {
        ob_start();
        $this->app->runControllerFromRawUrl($_GET['_url']);
        ob_clean();
    }
}
 