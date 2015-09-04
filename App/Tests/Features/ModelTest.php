<?php


namespace Tests\Features;

require_once(dirname(__FILE__) . '/../DatabaseTestCase.php');

use Tests\DatabaseTestCase;
use App\Application;
use RedBeanPHP\Facade as R;

class ModelTest extends DatabaseTestCase {


    /**
     * Cant have camelcased beans
     * @expectedException \RedBeanPHP\RedException
     */
    public function testTwoWordsCamelcasedBean() {
        R::freeze(false);
        $testName   = R::dispense('testName');
        $id         = R::store($testName);
        R::load('testName', $id);
        R::freeze($this->frozen);
    }

    /**
     * Cant have underscored beans
     * @expectedException \RedBeanPHP\RedException
     */
    public function testTwoWordsUnderscoredBean()  {
        R::freeze(false);
        $testName   = R::dispense('test_name');
        $id         = R::store($testName);
        R::load('test_name', $id);
        R::freeze($this->frozen);
    }
}
 