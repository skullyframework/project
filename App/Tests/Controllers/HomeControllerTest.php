<?php


namespace Tests\Controllers;

use Skully\App\Helpers\FileHelper;

require_once 'ControllerTest.php';

class HomeControllerTest extends ControllerTest {

    public function testSmartyTemplateDir()
    {
        $r = $this->app->getTemplateEngine()->getTemplateDir();
        $this->assertEquals(FileHelper::replaceSeparators($this->app->config('basePath').'public/default/App/views/'), $r['main']);
    }

    public function testSmartyPluginsDir()
    {
        $r = $this->app->getTemplateEngine()->getPluginsDir();
        $this->assertEquals(FileHelper::replaceSeparators($this->app->config('basePath').'App/smarty/plugins/'), $r[0]);
    }
    public function testIndex()
    {
        ob_start();
        $this->app->runControllerFromRawUrl($_GET['_url']);
        ob_clean();
    }
}
 