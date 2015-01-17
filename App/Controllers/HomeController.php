<?php
/*-------------------------------------------------\
 * Created by TrioDesign (trio@tgitriodesign.com).
 * Date: 10/28/13
 * Time: 9:11 AM
 * 
 \------------------------------------------------*/
namespace App\Controllers;

use Skully\App\Helpers\UrlHelper;
use RedBeanPHP\Facade as R;

class HomeController extends BaseController
{
	public function index(){
        $test = R::findOne('setting', "name = 'test setting'");
        $this->render('index', array('test' => $test->value));
	}
}