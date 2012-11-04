<?php 
// @todo fix links to use YII's URL management
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>UserModule::t('Manage User'), 'url'=>Yii::app()->createUrl('user/admin'), 'visible'=>UserModule::isAdmin()),
        array('label'=>UserModule::t('List Users'), 'url'=>Yii::app()->createUrl('user'), 'visible'=>!UserModule::isAdmin()),
		array('label'=>UserModule::t('Change Password'), 'url'=>Yii::app()->createUrl('user/profile/changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>Yii::app()->createUrl('user/logout')),
        array('label'=>UserModule::t('Edit Profile'), 'url'=>Yii::app()->createUrl('user/profile/edit')),
    ),
)); 
?>