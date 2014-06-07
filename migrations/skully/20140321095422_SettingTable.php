<?php

class SettingTable extends Ruckusing_Migration_Base
{
    public function up()
    {
        $t = $this->create_table('setting', array('options' => 'Engine=InnoDB collate=utf8_unicode_ci'));
        $t->column('name', 'string', array('length' => 100));
        $t->column('description', 'text');
        $t->column('value', 'text');
        $t->column('type', 'string', array('length' => 20, 'default' => 'string'));
        $t->column('is_client', 'boolean', array('default' => false));
        $t->column('input_type', 'string', array('length' => 20, 'default' => 'text'));
        $t->column('position', 'integer', array('default' => 0));
        $t->column('info', 'text');
        $t->column('is_visible', 'boolean', array('default' => true));
        $t->finish();
    }//up()

    public function down()
    {
        $this->drop_table('setting');
    }//down()
}
