<?php


namespace Tests;

require_once(dirname(__FILE__) . '/include.php');
require_once(dirname(__FILE__).'/../../bootstrap.php');
require_once(dirname(__FILE__) . '/functions.php');

use App\Application;
use RedBean_Facade as R;
use App\Config\Config;

abstract class DatabaseTestCase extends \PHPUnit_Framework_TestCase{
    /** @var Application */
    protected $app;

    protected $frozen = true;

    static $connection;

    protected function setUp()
    {
        $config = new Config();
        $config->setProtected('basePath', BASE_PATH);

        setCommonConfig($config);
        setUniqueConfig($config);

        $dbConfig = $config->getProtected('dbConfig');

        Application::setupRedBean($dbConfig['host'], $dbConfig['dbname'], $dbConfig['port'], $dbConfig['user'], $dbConfig['password'], $this->frozen);
        R::freeze(false);
        R::nuke();
        R::freeze($this->frozen);

        $this->app = __setupApp();

        /** $http Mock Http object. */
        $http = $this->getMock('Skully\Core\Http');
        $http->expects($this->any())
            ->method('redirect')
            ->will($this->returnCallback('stubRedirect'));
        $this->app->setHttp($http);
    }

    protected function migrate()
    {
        ob_start();
        $argv = array('db:migrate', '-t');
        require(realpath(dirname(__FILE__)).'/../tools/dbmigrator/ruckus.php');
        ob_clean();
    }

}