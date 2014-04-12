<?php


namespace App\Models\Traits;

/**
 * Class HasTimestamp
 * @package App\Models\Traits
 */
trait HasTimestamp {
    public function beforeCreate()
    {
        $this->bean->created_at = date(\DateTime::ISO8601);
    }

    public function beforeSave()
    {
        $this->bean->updated_at = date(\DateTime::ISO8601);
    }
} 