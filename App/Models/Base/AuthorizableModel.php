<?php


namespace App\Models\Base;

use Skully\App\Helpers\UtilitiesHelper;
use App\Models\BaseModel;

class AuthorizableModel extends BaseModel{
    protected $password;

    protected $password_confirmation;

    public function validatesOnCreate()
    {
        if (empty($this->password)) {
            $this->addError($this->app->getTranslator()->translate('passwordEmpty'), 'password');
        }
    }
    public function validatesOnSave()
    {
//        $this->app->getLogger()->log("validate on save authorizableModel : " . $this->password . " == " . $this->password_confirmation);
        if ($this->password != $this->password_confirmation) {
//            $this->app->getLogger()->log("password mismatch");
            $this->addError($this->app->getTranslator()->translate('passwordConfirmationWrong'), 'passwordConfirmation');
        }
    }

    public function beforeSave()
    {
//        $this->app->getLogger()->log("before save authorizableModel");
        if (!empty($this->password)) {
            $this->set('salt', time());
            $this->set('password_hash', UtilitiesHelper::toHash($this->password, $this->get('salt'), $this->app->config('globalSalt')));
        }
        $this->removeProperty('password');
        $this->removeProperty('password_confirmation');
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password_confirmation
     */
    public function setPasswordConfirmation($password_confirmation)
    {
        $this->password_confirmation = $password_confirmation;
    }

    /**
     * @return mixed
     */
    public function getPasswordConfirmation()
    {
        return $this->password_confirmation;
    }
} 