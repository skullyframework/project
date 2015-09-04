<?php
namespace App\Controllers\Admin;

use App\Models\Admin;
use RedBeanPHP\Facade as R;
use Skully\App\Helpers\TimeHelper;

class AdminsController extends \SkullyAdmin\Controllers\AdminsController {

    public $columns         = array('Email', 'Name', 'Type / Level', 'Status', 'Created At', '');
    public $thAttributes    = array('', '', '', '', '', '', 'class="sort_desc"', ''); // Class sort_asc or sort_dsc can be used to set default sorting.


    protected function listData() {
        $instances      = R::findAll($this->model());
        $instanceList   = array();

        if (!empty($instances)) {
            foreach($instances as $instance) {
                $actions = '<div class="text-right" style="min-width: 40px;"><a title="View" href="'.$this->app->getRouter()->getUrl('admin/admins/edit', array('id' => $instance->id)).'" data-toggle="dialog"><span class="fa fa-pencil"></span></a>
					<a title="Delete" href="'.$this->app->getRouter()->getUrl('admin/admins/delete', array('id' => $instance->id)).'" data-toggle="dialog"><span class="fa fa-trash"></span></a></div>';

                if($instance->type == Admin::TYPE_ADMIN){
                    $type = '<span class="label label-danger">Admin</span>';
                }
                else{
                    $type = '';
                }

                $instanceList[] = array(
                    $instance->email,
                    $instance->name,
                    $type,
                    $instance->status,
                    TimeHelper::date($this->app->config('adminLongDateTimeFormat'), $instance->created_at),
                    $actions
                );
            }
        }
        return $instanceList;
    }

    protected function setupAdditionalAssigns($instance){
        parent::setupAdditionalAssigns($instance);

        $this->app->getTemplateEngine()->assign(array(
            "types" => array(
                Admin::TYPE_ADMIN => "Administrator"
            )
        ));
    }
}
