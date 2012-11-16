<div id='keyresponse'></div>
<?php  
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'keys-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$keysDataProvider,
	'template'=>"{items}",
	'selectableRows' => 0,
	'columns'=>array(
		array('name'=>'Status', 'value'=>'$data->isActive ? "Enabled" : "Disabled"'),
		array('name'=>'keyID', 'header'=>'Key'),
		array('name'=>'vCode', 'header'=>'vCode'),
		array('name'=>'activeAPIMask', 'header'=>'Access Mask'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>"<span class='right'>{enable}{disable}{delete}</span>",
			 'buttons' => array (
				'delete' => array
				(
					'label' => 'Delete',
					'url'   => 'Yii::app()->createUrl("user/profile/deleteKey", array("id"=>$data->keyID))',
				),
				'disable' => array
				(
					'label' => 'Disable',
					'icon'  => 'minus',
					'url'   => 'Yii::app()->createUrl("user/profile/disableKey", array("id"=>$data->keyID))',
					'visible' => '$data->isActive == 1',
					'options'=>array(  
						'ajax'=>array(
							'url'=>"js:$(this).attr('href')", 
							'update'=>'#keyresponse', //display a response
							'success'=> "js:function(data){
								console.log(data);
								$.fn.yiiGridView.update('keys-grid');}"
							
						),
					),
				),
				'enable' => array
				(
					'label' => 'Enable',
					'icon'  => 'plus',
					'url'   => 'Yii::app()->createUrl("user/profile/enableKey", array("id"=>$data->keyID))',
					'visible' => '$data->isActive == 0',
					'options'=>array(  
						'ajax'=>array(
							'url'=>"js:$(this).attr('href')", 
							'update'=>'#keyresponse', //display a response
							'success'=> "js:function(data){
								console.log(data);
								$.fn.yiiGridView.update('keys-grid');}"
						),
					),
				),  
			),
		),
	),
));
?>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
	'type'=>'primary',
	'url' => Yii::app()->createUrl("user/profile/addApi"),
	'label' => 'Add API',
	'size'=>'mini',
	'htmlOptions'=> array(
		'class' => 'update-dialog-open-link right',
		'data-update-dialog-title' => Yii::t( 'app', 'Add API' ),
		'data-update-dialog-type' => 'create',
	)
));
?>