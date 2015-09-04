<?php


namespace App\Models\Repositories;


use App\Helpers\ApiHelper;

class BaseRepository extends \Skully\App\Models\Repositories\BaseRepository {
    /** @var \App\Application */
    protected $app;

    /** @var  \App\Helpers\ApiHelper $apiHelper */
    protected $apiHelper;

    function __construct($app = null) {
        parent::__construct($app);

        $this->apiHelper = new ApiHelper();
        $this->apiHelper->setApp($this->app);
    }
} 