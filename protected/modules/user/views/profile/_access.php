<?php
//print_r($model);
//exit;



//$dataProvider->setPagination(false);

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$dataProvider,
    'id'=>'access-grid',
    'type'=>'striped bordered condensed',
	'template'=>"{items}",
    'columns'=>array(
        array('name'=>'api', 'header'=>'API Call'),
        array('name'=>'description', 'header'=>'Description'),
        array('name'=>'mask', 'header'=>'Mask'),
		array('name'=>'Enabled', 'value' => '('.$model[0]->activeAPIMask.' & $data->mask) ? "yes" : "no"'),
    ),
));
 
?>