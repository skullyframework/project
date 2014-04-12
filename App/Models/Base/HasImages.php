<?php


namespace App\Models\Base;

use Skully\App\Helpers\UtilitiesHelper;
use App\Models\BaseModel;

class HasImages extends BaseModel{
    public function imageBaseUrl()
    {
        return 'models/' . $this->id . '/';
    }

    public function imageBasePath()
    {
        return $this->app->getTheme()->getPublicBasePath() . 'models/' . $this->id . '/';
    }

    /**
     * @return array|mixed
     */
    public function getImages()
    {
        try {
//            return json_decode(json_decode($this->bean->images, true));
            return UtilitiesHelper::decodeJson($this->bean->images, true);
        }
        catch (\Exception $e) {
            return array();
        }
    }

    public function getMainImage()
    {
        $images = $this->getImages();
        return $images[0];
    }

    public function setImages($values = array())
    {
        $this->bean->images = json_encode($values);
    }

} 