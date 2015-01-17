<?php
/*-------------------------------------------------\
 * Created by TrioDesign (trio@tgitriodesign.com).
 * Date: 10/28/13
 * Time: 9:11 AM
 * 
 \------------------------------------------------*/
namespace App\Controllers;

use Skully\App\Helpers\UrlHelper;

class HomeController extends BaseController
{
	public function index(){
        $dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $ishttps = UrlHelper::isSecure();
        $this->render('index', array('dburl' => $dburl, 'ishttps' => $ishttps));
	}
}