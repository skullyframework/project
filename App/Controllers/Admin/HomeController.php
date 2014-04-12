<?php

namespace App\Controllers\Admin;
class HomeController extends BaseController {

	public function index() {
		$this->render('index');
	}

	public function noPermission() {
		$this->render('noPermission');
	}

	public function notFound() {
		$this->render('notFound');
	}

	public function updateNumDisplayedRows(){
		$this->setNumDisplayedRows($this->params["numRows"]);
	}

    protected function beforeAction()
    {
        parent::beforeAction();
        if ($this->getParam('showLogin') == 1 && empty($this->user)) {

        }
    }
}