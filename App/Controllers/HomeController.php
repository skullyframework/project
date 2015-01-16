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
        $dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->render('index', array('dburl' => $dburl));
	}
}