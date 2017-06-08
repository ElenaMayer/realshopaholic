<?php
/**
 * @link https://github.com/amilna/yii2-nivo-slider
 * @copyright Copyright (c) 2015 Amilna
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace amilna\nivoslider;

use Yii;
use yii\web\AssetBundle;

class NivoSliderAsset extends AssetBundle
{
    public $sourcePath = '@amilna/nivoslider/assets';
	
	public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
	
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js[] = '/nivo-slider/jquery.nivo.slider.pack.js';       
    }    
}
