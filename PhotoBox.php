<?php

/**
 * @package   yii2-photobox
 * @version   0.0.1
 */

namespace cnxfaeton\base;

use Yii;

class PhotoBox extends \yii\base\Widget
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/kv-widgets']);
        parent::init();
    }
	
}