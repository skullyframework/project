<?php

use RedBeanPHP\Facade as R;

class Settings extends Ruckusing_Migration_Base {

    public function up() {
        $app        = __setupApp();

        $setting    = $app->createModel('setting', array(
            'name'          => 'mainMetaTitle',
            'description'   => 'Meta Title',
            'value'         => 'Meta Title',
            'is_visible'    => true,
            'is_client'     => false,
            'input_type'    => 'text'
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'mainMetaDescription',
            'description'   => 'Meta Description',
            'value'         => 'Meta Description',
            'is_visible'    => true,
            'is_client'     => false,
            'input_type'    => 'textarea'
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'mainMetaKeywords',
            'description'   => 'Meta Keywords',
            'value'         => 'Meta Keywords',
            'is_visible'    => true,
            'is_client'     => false,
            'input_type'    => 'textarea'
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'adminEmail',
            'description'   => 'Administrator Email',
            'value'         => 'admin@triodigitalagency.com',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'smtpSecurity',
            'description'   => "SMTP security",
            'value'         => 'ssl',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'smtpPort',
            'description'   => "SMTP port",
            'value'         => '465',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'smtpHost',
            'description'   => 'SMTP host',
            'value'         => 'heroic.hostingheroes.net',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'smtpPassword',
            'description'   => 'SMTP password',
            'value'         => 'yvpB43dsoG;e',
            'is_visible'    => true,
            'is_client'     => false,
            'input_type'    => 'password'
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'smtpUsername',
            'description'   => 'SMTP username',
            'value'         => 'no-reply@triodigitalagency.com',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'senderEmail',
            'description'   => 'Sender Email',
            'value'         => 'no-reply@triodigitalagency.com',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'senderName',
            'description'   => 'Sender Name',
            'value'         => 'Sender Name',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'replyToEmail',
            'description'   => 'Reply-to Email',
            'value'         => 'your@email.com',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);

        $setting    = $app->createModel('setting', array(
            'name'          => 'replyToName',
            'description'   => 'Reply-to Name',
            'value'         => 'Your Name',
            'is_visible'    => true,
            'is_client'     => false
        ));
        R::store($setting);
    }//up()

    public function down() {
        $this->execute("TRUNCATE setting");
    }//down()
}
