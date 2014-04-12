<?php


namespace App\Models;

use App\Models\Traits\HasTimestamp;
use App\Models\Base\AuthorizableModel;

class Admin extends AuthorizableModel{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    use HasTimestamp {
        beforeSave as tsBeforeSave;
    }

    public function beforeSave()
    {
        $this->tsBeforeSave();
        parent::beforeSave();
    }
    public function validatesExistenceOf()
    {
        return array('name', 'email');
    }
}