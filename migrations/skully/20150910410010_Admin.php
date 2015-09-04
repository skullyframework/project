<?php

use \RedBeanPHP\Facade as R;

class Admin extends Ruckusing_Migration_Base {

    public function up() {
        $app    = __setupApp();
        $admin  = $app->createModel('admin', array(
            'name'                  => 'Admin',
            'email'                 => 'admin@triodigitalagency.com',
            'password'              => 'passw0rd',
            'password_confirmation' => 'passw0rd',
            'status'                => \App\Models\Admin::STATUS_ACTIVE
        ));
        R::store($admin);
    }//up()

    public function down() {
    }//down()
}
