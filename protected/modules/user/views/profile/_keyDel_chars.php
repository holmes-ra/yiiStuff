<li><?php 
if ($data->keys == null) {
	$this->widget('bootstrap.widgets.TbLabel', array(
		'type'=>'important',
		'label'=>'Delete',
	)); 
}
else {
	$this->widget('bootstrap.widgets.TbLabel', array(
		'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
		'label'=>'Modify',
	)); 
}
echo " <strong>".$data->characterName."</strong>"; 
?></li>