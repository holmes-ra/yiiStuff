<div id='keyresponse'></div>
<?php  
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'keys-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$keysDataProvider,
	'template'=>"{items}",
	'selectableRows' => 0,
	'rowCssClassExpression' => '$data->isActive ? null : "error"',
	'columns'=>array(
		array('name'=>'Status', 'type'=>'raw', 'value'=>'$this->grid->getOwner()->renderPartial(\'_keyGrid_statusCol\', array(\'data\'=>$data),true);'),
		array('name'=>'keyID', 'header'=>'Key'),
		array('name'=>'vCode', 'header'=>'vCode'),
		array('name'=>'info.type', 'header'=>'Type'),
		array('name'=>'activeAPIMask', 'header'=>'Access Mask'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>"<span class='right'>{refresh}{delete}</span>",
			 'buttons' => array (
			 	'refresh' => array
				(
					'label' => 'Refresh',
					'icon'  => 'refresh',
					'url'   => 'Yii::app()->createUrl("user/profile/refreshKey", array("id"=>$data->keyID))',
					'options'=>array(  
						'ajax'=>array(
							'url'=>"js:$(this).attr('href')", 
							'success'=> "js:function(data){
								$('#keyFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
								$.fn.yiiGridView.update('key-grid'); }"  
						),
					),
				), 
				'delete' => array
				(
					'label' => 'Delete',
					'url'   => 'Yii::app()->createUrl("user/profile/deleteKey", array("id"=>$data->keyID))',
					'click' => 'updateDialogOpen',
					'options'=>array(  
						'data-update-dialog-title' => Yii::t( 'app', 'Delete Key' ),
						'data-update-dialog-type' => 'delete',
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