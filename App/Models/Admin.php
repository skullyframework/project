<?php


namespace App\Models;

use App\Models\Traits\HasTimestamp;
use App\Models\Base\AuthorizableModel;
use Skully\App\Models\Traits\Authorizable;

class Admin extends BaseModel {
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    use Authorizable {
        beforeSave as aBeforeSave;
    }

    use HasTimestamp {
        beforeSave as tsBeforeSave;
    }

    public function beforeSave()
    {
        $this->aBeforeSave();
        $this->tsBeforeSave();
        parent::beforeSave();
    }
    public function validatesExistenceOf()
    {
        return array('name', 'email');
    }
}