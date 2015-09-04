<?php


namespace Tests;

require_once('include.php');
require_once(dirname(__FILE__).'/../../bootstrap.php');

class ApplicationTest extends \PHPUnit_Framework_TestCase {
    public function testThemeUrl() {
        $app = __setupApp();
        $this->assertEquals($app->config('baseUrl').'public/', $app->getTheme()->getPublicBaseUrl());
    }
}
 