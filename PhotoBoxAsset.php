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
    public $sourcePath = '@vendor/cnx-faeton/photobox';

    public $js = [];
    
    public $css = [
        'styles.css',
		'photobox/photobox.css',
		'photobox/photobox.ie.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
    public function registerAssetFiles($view) {
        $this->js[] = 'photobox/jquery.photobox.js';
        parent::registerAssetFiles($view);
    }
} 