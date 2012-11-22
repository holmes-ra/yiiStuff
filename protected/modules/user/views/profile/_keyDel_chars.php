<li><?php 

if ($data->keys == null) {
	$this->widget('bootstrap.widgets.TbLabel', array(
		'type'=>'important',
		'label'=>'Delete',
	)); 
	echo " <strong>".$data->characterName."</strong>"; 
}
else {
	$mask = 0;
	foreach ($data->keys AS $key) {
		$mask = $mask | $key->activeAPIMask;
	}
	if ($mask != $data->activeAPIMask) {
		$this->widget('bootstrap.widgets.TbLabel', array(
			'type'=>'info',
			'label'=>'Modify',
		));
		echo " <strong>".$data->characterName."</strong>"; 
	}
	else {
		$this->widget('bootstrap.widgets.TbLabel', array(
			'type'=>'success',
			'label'=>'No Change',
		));
		echo " <strong>".$data->characterName."</strong>";
	}
}
?></li>