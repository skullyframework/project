<?php
namespace Tests;

require_once(dirname(__FILE__) . '/DatabaseTestCase.php');

use RedBeanPHP\Facade as R;

class DatabasePreparationTest extends DatabaseTestCase {
    public function testDatabasePreparation(){
        R::freeze(false);
        R::nuke();
        R::freeze(true);

        $this->migrate();
    }
}