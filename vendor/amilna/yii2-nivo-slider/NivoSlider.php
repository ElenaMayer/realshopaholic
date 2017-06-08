<?php
/**
 * @link https://github.com/amilna/yii2-nivo-slider
 * @copyright Copyright (c) 2015 Amilna
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace amilna\nivoslider;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Widget renders a Nivo Slider widget.
 *
 * For example:
 *
 * use amilna\nivoslider\NivoSlider;
 * 
 * echo NivoSlider::widget([
 * 		'dataProvider'=>$dataProvider, // active data provider or just array of image,url, title and description, exp: [["image"=>"test1.jpg","url"=>null],["image"=>"test2.jpg","url"=>null]]
 * 		'targetId'=>'nivoslider',	//id of rendered nivoslider (the container will constructed by the widget with the given id)		
 * 		'imageKey'=>'image', //model attribute to be used as background
 * 		'theme' => 'default', //available themes: default, bar, dark, light
 *  	'css' => '', // url of css to overide default css relative from @web	  		
 * 		
 * 		
 * 		//	example to overide default options	more options on http://docs.dev7studios.com/jquery-plugins/nivo-slider
 * 		'options'=>[
 * 				'effect'=> 'boxRandom',
 * 				'manualAdvance'=>false,
 * 				'controlNav'=> false				
 * 			],		
 * 		 						
 * 	]); 
 *
 * @author Amilna
 * @see https://github.com/gilbitron/Nivo-Slider
 * @package amilna\nivoslider
 */
class NivoSlider extends Widget
{
    
    public $dataProvider = null;
    public $itemView = null;
    public $itemPager = null;    
    public $titleKey = 'title';
    public $imageKey = 'image';
    public $descriptionKey = 'description';    
    public $urlKey = 'url';
    
    public $options = [
					'effect'=> 'random',
					'manualAdvance'=>false,
					'controlNav'=> false	
				];
	
	public $targetId = 'sliderNivo';			    
    public $showText = false;                    
    public $theme = 'default'; // available options 'dark','light', 'bar'    
    public $css = null;
    
    private $bundle = null;
    private $data = [];

    public function init()
    {
        parent::init();
        $view = $this->getView();				
		
		$bundle = NivoSliderAsset::register($view);
		$this->bundle = $bundle;
		$view->registerCssFile("{$bundle->baseUrl}/nivo-slider/nivo-slider.css");
        if ($this->theme !== false && $this->css == null) {
			$view->registerCssFile("{$bundle->baseUrl}/nivo-slider/themes/{$this->theme}/{$this->theme}.css");
        }
        else
        {
			$view->registerCssFile("@web/{$this->css}");
		}
		
		if (!empty($this->dataProvider))
		{	
			if (count($this->dataProvider->getModels()) > 0)
			{															
				$titleKey = $this->titleKey;
				$imageKey = $this->imageKey;
				$descriptionKey = $this->descriptionKey;
				$urlKey = $this->urlKey;			           
				foreach ($this->dataProvider->getModels() as $key=>$model)
				{						
					$this->data[] = [
						"image"=>$model->$imageKey,
						"url"=>$model->$urlKey,
						"title"=>$model->$titleKey,
						"description"=>$model->image_only?'':$model->$descriptionKey,
					];
				}				
			}
			else
			{
				$this->data = $this->dataProvider;
			}				
		}
		
		if (!empty($this->data))
		{
		
		echo '	<div class="slider-bootstrap"><!-- start slider -->					
					<div class="slider-wrapper theme-'.$this->theme.'">
						<div class="ribbon"></div>
						<div id="'.$this->targetId.'" class="nivoSlider">';
						
				$banner_count	= 1;
				foreach ($this->data as $b=>$banner)
				{															
					
					$dtrans = ['fade','slideInLeft'];
					$dc = count($dtrans);
					$d = $b%$dc;						
					
					//$html =  Html::img($banner['image'],['data-transition'=>$dtrans[$d],'data-thumb'=>$banner['image'],'alt'=>$banner['title'],'title'=>$banner['description']]);					
					$html =  Html::img($banner['image'],['data-thumb'=>$banner['image'],'alt'=>$banner['title'],'title'=>$banner['description']]);					
					
					$islink =false;
					if(isset($banner['url']))
					{											
						if(!empty($banner['url']))
						{							
							$islink = true;
						}						
					}
										
					if($islink)
					{
						echo Html::a($html,$banner['url'],['target'=>'_blank']);
					}
					else
					{
						echo $html;	
					}
				
					$banner_count++;
				}
				
		echo '        </div>
				</div>
			</div> <!-- /slider -->';
			
		}	
		
		
        if (!empty($this->targetId)) {
            $script = '';
            $divid = $this->targetId;
            
			$options = Json::encode($this->options);                
			$script .= "
			 $(function() {
				$('#".$divid."').nivoSlider($options);
			});
			" . PHP_EOL;
			
		
            $view->registerJs($script);
        }
        
    }        
}
