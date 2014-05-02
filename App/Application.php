<?php

namespace App;

use App\Controllers\BaseController;
use RedBean_Facade as R;
use Skully\Core\ConfigInterface;
use Skully\Core\Templating\SmartyAdapter;
use Skully\Exceptions\InvalidConfigException;


class Application extends \Skully\Application {

    //facebook
    private $_fb = null;
    private $_fbLoginUrl = '';
    private $_fbLogoutUrl = '';

    /**
     * @param ConfigInterface $config
     * @throws InvalidConfigException
     */
    public function __construct(ConfigInterface $config)
    {
        parent::__construct($config);
        $this->mergeSettingsToConfig();
    }
    public function getAdmin()
    {
        /** @var \RedBean_SimpleModel $adminBean */
        $adminBean = R::findOne('admin', "id = ?", array($this->getSession()->get('adminId')));
        if (!empty($adminBean)) {
            return $adminBean->box();
        }
        else {
            return null;
        }
    }

    public function facebook(){
//		errorLog("facebook");
        if(empty($this->_fb)){
//			errorLog("new facebook");
            $this->_fb = new \Facebook(array(
                "appId" => $this->config("facebookAppId"),
                "secret" => $this->config("facebookSecret")
            ));
        }
        return $this->_fb;
    }

    public function facebookLoginUrl($redirectUri = ''){
        if(empty($this->_fbLoginUrl) && empty($redirectUri)){
            $redirectUri = ($_SERVER["HTTP_HOST"] == "localhost" ? $this->config("baseUrl") : $this->config('facebookAppUrl')) . "users/login";

            $this->_fbLoginUrl = $this->facebook()->getLoginUrl(array(
                'scope' => $this->config('facebookAppScope'),
                'redirect_uri' => $redirectUri
            ));
        }
        else if(!empty($redirectUri)){
            $redirectUri = ($_SERVER["HTTP_HOST"] == "localhost" ? $this->config("baseUrl") : $this->config('facebookAppUrl')) . "users/login?redirectUri=" . urlencode($redirectUri);
            return $this->facebook()->getLoginUrl(array(
                'scope' => $this->config('facebookAppScope'),
                'redirect_uri' => $redirectUri
            ));
        }
        return $this->_fbLoginUrl;
    }

    public function facebookLogoutUrl(){
        if(empty($this->_fbLogoutUrl)){
            $this->_fbLogoutUrl = $this->facebook()->getLogoutUrl(array(
                'next' => $this->getRouter()->getUrl("users/logout")
            ));
        }
        return $this->_fbLogoutUrl;
    }

    /**
     * Merge settings to config.
     */
    protected function mergeSettingsToConfig() {
        $settings = R::findAll('setting');
        if (!empty($settings)) {
            foreach($settings as $setting) {
                $value = $setting->value;
                settype($value, $setting->type);
                if ($setting->is_client) {
                    $this->config->setPublic($setting->name, $value);
                }
                else {
                    $this->config->setProtected($setting->name, $value);
                }
            }
        }
    }

    public function getTemplateEngine()
    {
        if (empty($this->templateEngine)) {
            $caching = 0;
            // Smarty caching is currently broken (v.3.1.16) so we disable it
//            if (!$this->configIsEmpty('caching')) {
//                $caching = $this->config('caching');
//            }
            $this->templateEngine = new SmartyAdapter($this->config('basePath'), $this->config('theme'), $this, $this->additionalTemplateEnginePluginsDir(), $caching);
            $this->templateEngine->registerObject('app', $this);
        }
        return $this->templateEngine;
    }
}