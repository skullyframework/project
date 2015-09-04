<?php

namespace App\Controllers\Admin;

use SkullyAdmin\Controllers\BaseController;

class HomeController extends BaseController {

	public function index() {
		$this->render('index');
	}
}