<?php


namespace Tests\Controllers;


require_once 'ControllerTest.php';
require_once(dirname(__FILE__) . '/../functions.php');

class BaseControllerTest extends ControllerTest {
    /**
     * This method tests all views within this app, ensuring no error was found.
     */
    public function testAllViews() {
        $app    = __setupApp();

        /** $http Mock Http object. */
        $http   = $this->getMock('Skully\Core\Http');
        $http->expects($this->any())
            ->method('redirect')
            ->will($this->returnCallback('stubRedirect'));
        $app->setHttp($http);

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->app->getTheme()->getBasePath())) as $filename) {
            if (preg_match('/^.*\.(tpl)$/i', $filename) && strpos($filename, '_') === false) {
                $routeFile      = str_replace(array($this->app->getTheme()->getBasePath(), '.tpl'), '', $filename);
                $routeFile_r    = explode('/', $routeFile);
                array_shift($routeFile_r);
                array_shift($routeFile_r);
                array_shift($routeFile_r);

                $route          = implode('/', $routeFile_r);

                echo "about to run $route\n";
//                ob_start();
                $app->runControllerFromRawUrl($route);
//                ob_clean();
                echo "tested route $route\n";
            }
        }
        $this->assertTrue(true);
    }
}
 