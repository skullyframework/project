<?php


namespace App\Models\Repositories;

use RedBeanPHP\Facade as R;

class SettingRepository extends BaseRepository {

    /**
     * @param string $name
     * @return \App\Models\Setting
     */
    function getSetting($name) {
        /** @var \RedBean_SimpleModel $bean */
        $bean = R::findOne('setting', 'name = ?', array($name));
        return $bean->box();
    }
}