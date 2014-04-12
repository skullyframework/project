<?php

namespace App\Controllers;

use App\Application;

class BaseController extends \Skully\App\Controllers\BaseController {
    /** @var  Application */
    protected $app;

    protected function beforeAction()
    {

    }

    protected function beforeRender()
    {
        $this->setDefaultAssign();
    }

	protected function setDefaultAssign()
    {
		$this->showSetMessages();

		if (!($this->app->configIsEmpty('localTest'))) {
			$this->app->getTemplateEngine()->assign(array('localTest' => $this->app->config('localTest')));
		}
		$this->app->getTemplateEngine()->assign(array(
			'isLogin' => false,
			'baseUrl' => $this->app->config('baseUrl'),
			'themeUrl' => $this->app->getTheme()->getPublicBaseUrl(),
			'xmlLang' => $this->app->getXmlLang(),
			'language' => $this->app->getLanguage(),
			'clientConfig' => $this->app->clientConfig(),
			'isAjax' => $this->app->isAjax(),
            'params' => $this->params,
            'route' => $this->getControllerPath(),
            'action' => $this->getCurrentAction()
		));
	}

    /**
     * @param null $viewPath
     * @param array $assignParams
     * @return void
     */
    public function render($viewPath = null, $assignParams = array())
    {
        $this->setDefaultAssign();
        parent::render($viewPath, $assignParams);
    }
}
