<?php

/**
 * @copyright Copyright (c) 2014 Newerton Vargas de Araújo
 * @link http://newerton.com.br
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package yii2-fancybox
 * @version 1.0.0
 */

namespace cnxfaeton\photobox;

use yii\base\Widget;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

/**
 * fancyBox is a tool that offers a nice and elegant way to add zooming 
 * functionality for images, html content and multi-media on your webpages
 *
 * @author Newerton Vargas de Araújo <contato@newerton.com.br>
 * @since 1.0
 */
class PhotoBox extends Widget {

    public $items;

    /**
     * @inheritdoc
     */
    public function init()
	{
        if (is_null($this->items)) {
            throw new InvalidConfigException('"PhotoBox.items has not been defined.');
        }
        // publish the required assets
        $this->registerClientScript();
    }

    /**
     * @inheritdoc
     */
    public function run() {
		$view = $this->getView();

        PhotoBoxAsset::register($view);

//        $config = Json::encode($this->config);
		
		$jsonitems=  json_encode($this->items);
		$js=<<<HTML
 (function(){
    'use strict';

	var gallery = $('#gallery');
	var f=function(data)
	{
		var loadedIndex = 1;
		console.log(data);
        $.each( data.items, function(index, photo){
			console.log(photo);
            var url = photo.preview,
				img = document.createElement('img');
			
			// lazy show the photos one by one
			img.onload = function(e){
				img.onload = null;
				var link = document.createElement('a'),
				li = document.createElement('li')
				link.href = this.largeUrl;

				link.appendChild(this);
				li.appendChild(link);
				gallery[0].appendChild(li);
			
				setTimeout( function(){ 
					$(li).addClass('loaded');
				}, 25*loadedIndex++);
			};
			
			img['largeUrl'] = photo.url;
			img['isVideo'] = true;
			img.src = photo.preview;
			img.title = photo.title;
        });

		// finally, initialize photobox on all retrieved images
		$('#gallery').photobox('a', { thumbs:true, loop:false }, callback);
		// using setTimeout to make sure all images were in the DOM, before the history.load() function is looking them up to match the url hash
		setTimeout(window._photobox.history.load, 2000);
		function callback(){
			console.log('callback for loaded content:', this);
		};
    }($jsonitems);
})();

HTML;
		
		
        $view->registerJs($js);
    }

    /**
     * Registers required script for the plugin to work as DatePicker
     */
    public function registerClientScript() {
        $view = $this->getView();

        $assets = PhotoBoxAsset::register($view);

//        $view->registerCssFile($assets->baseUrl . '/style.css', ['depends' => \newerton\fancybox\FancyBoxAsset::className()]);
//            $view->registerCssFile($assets->baseUrl . '/helpers/jquery.fancybox-thumbs.css', ['depends' => \newerton\fancybox\FancyBoxAsset::className()]);

//            $view->registerJsFile($assets->baseUrl . '/helpers/jquery.fancybox-buttons.js', ['depends' => \newerton\fancybox\FancyBoxAsset::className()]);
    }

}
