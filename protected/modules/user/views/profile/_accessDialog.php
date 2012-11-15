

<div id="dialog-fixed">
<?php


/*
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'label'=>'Primary',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
      //  'block' => true,
    'htmlOptions'=>array()
)); 
/**/
//echo CHtml::submitButton("Edit Access Mask", array());




 
?></div>
<?php
$form=$this->beginWidget('CActiveForm', array(
        'id'=>'access-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
));
//print_r($model);
//exit;

//$dataProvider->setPagination(false);

/*
$ajaxOptions = array(
   // 'url'=>"js:$(this).attr('href')", 
    'success'=> "js:function(data){
        $('#accessFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
         }"  
);


$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'htmlOptions'=>array('id'=>'accessFlash', 'style'=>'margin-bottom:-20px;'),
));
*/

$dataProvider->setPagination(false);
$this->widget('bootstrap.widgets.TbGridView', array(
    'baseScriptUrl' => Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.assets.js')).'/gridview',
    'dataProvider'=>$dataProvider,
    'id'=>'access-grid',
    'type'=>'striped bordered',
    'template'=>"{items}",
    'selectableRows'=>2,
    'columns'=>array(
        array(
            'checked' => '('.$char->activeAPIMask.' & '.$availableMask.' & $data->mask)',
            'value'=>'$data->mask',
            'class'=>'ext.ECheckBoxColumn',
            'disabled'=>'!('.$availableMask.' & $data->mask)',
            'checkBoxHtmlOptions'=>array('name'=>'mask[]'),
        ),
        array('header'=>'API Call', 'value' => '$data->api'),
    ),
));

$this->endWidget();
?>


    


