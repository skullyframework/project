<?php


namespace App\Models;

use Skully\App\Models\Traits\Authorizable;
use Skully\App\Models\Traits\HasTimestamp;

class Admin extends BaseModel {
    const TYPE_ADMIN        = 'admin';
    const STATUS_ACTIVE     = 'active';
    const STATUS_INACTIVE   = 'inactive';

    use Authorizable, HasTimestamp {
        Authorizable::beforeSave as aBeforeSave;
        HasTimestamp::beforeSave as tsBeforeSave;
    }

    public function beforeSave() {
        $this->aBeforeSave();
        $this->tsBeforeSave();
        parent::beforeSave();
    }

    public function validatesExistenceOf() {
        return array('name', 'email');
    }
}