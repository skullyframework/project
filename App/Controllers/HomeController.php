<?php
/*-------------------------------------------------\
 * Created by TrioDesign (trio@tgitriodesign.com).
 * Date: 10/28/13
 * Time: 9:11 AM
 * 
 \------------------------------------------------*/
namespace App\Controllers;

class HomeController extends BaseController
{
	public function index(){
        $this->render('index');
	}
}