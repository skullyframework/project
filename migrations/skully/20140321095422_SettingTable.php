<?php

class SettingTable extends Ruckusing_Migration_Base
{
    public function up()
    {
        $this->execute(
            "
            drop table if exists `setting`;
            CREATE TABLE `setting` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(100) DEFAULT NULL,
              `value` text,
              `type` varchar(20) DEFAULT 'string',
              `is_client` tinyint(1) DEFAULT '0',
              `input_type` varchar(20) DEFAULT 'text',
              `position` int(11) unsigned DEFAULT '0',
              `is_visible` tinyint(11) unsigned DEFAULT '1',
              `info` text,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
        );
    }//up()

    public function down()
    {
    }//down()
}
