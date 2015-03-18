<?php
/**
 * @copyright Copyright (c) 2014 Newerton Vargas de Araújo
 * @link http://newerton.com.br
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace cnxfaeton\photobox;

use yii\web\AssetBundle;

class PhotoBoxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/cnx-faeton/photobox/';

    public $js = [];
    
    public $css = [
        'jquery.fancybox.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
    public function registerAssetFiles($view) {
        $this->js[] = 'jquery.fancybox' . (!YII_DEBUG ? '.pack' : '') . '.js';
        parent::registerAssetFiles($view);
    }
} 