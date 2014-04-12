<?php


namespace Tests\Features;

require_once(dirname(__FILE__) . '/../DatabaseTestCase.php');

use Tests\DatabaseTestCase;
use App\Application;
use RedBean_Facade as R;
use RedBean_Exception_Security;

class ModelTest extends DatabaseTestCase {


    /**
     * Cant have camelcased beans
     * @expectedException RedBean_Exception_Security
     */
    public function testTwoWordsCamelcasedBean()
    {
        R::freeze(false);
        $testName = R::dispense('testName');
        $id = R::store($testName);
        R::load('testName', $id);
        R::freeze($this->frozen);
    }

    /**
     * Cant have underscored beans
     * @expectedException RedBean_Exception_Security
     */
    public function testTwoWordsUnderscoredBean()
    {
        R::freeze(false);
        $testName = R::dispense('test_name');
        $id = R::store($testName);
        R::load('test_name', $id);
        R::freeze($this->frozen);
    }

    public function testMeta()
    {
        $this->migrate();
        R::exec(file_get_contents(dirname(__FILE__).'/db/products.sql'));
        $test = R::findOne('product');
        $test->box()->setMeta('test', array('test'));
        $exported = $test->box()->export(true);
        $this->assertEquals(array('test'), $exported['test']);
    }

    public function testValidation()
    {
        $product = $this->app->createModel('product');
        $this->assertEquals(array('name'), $product->validatesExistenceOf());
    }

    public function testTitleField()
    {
        R::freeze(false);
        $bean = R::dispense('try');
        $bean->title = 'test';
        R::store($bean);
        $beanFound = R::findLast('try');
        $this->assertEquals('test', $beanFound->title);
        R::freeze(true);
        $this->migrate();
        $news = R::dispense('news');
        $news->import(array('title' => 'test news', 'newscategory_id' => 1));
        R::store($news);
        $newsFound = R::findLast('news');
        $this->assertEquals('test news', $newsFound->title);
        R::freeze($this->frozen);
    }
}
 