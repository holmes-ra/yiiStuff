<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
<?php
$array = array();

$menu = array(
   array('label'=>'Settings', 'url'=>Yii::app()->getModule('user')->profileUrl),
   array('label'=>'Logout', 'url'=>Yii::app()->getModule('user')->logoutUrl),
   '---',
);
/*
if (!Yii::app()->user->isGuest) {
	foreach (Yii::app()->user->characters AS $char) {
		$menu[] = array('label'=>$char->characterName, 'url'=>Yii::app()->createUrl("/user/profile/switch", array("id"=>$char->characterID)));
	}
}
/**/
 $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'null', // null or 'inverse'
    'brand'=>CHtml::encode(Yii::app()->name),
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>Yii::app()->getBaseUrl()),
            ),
        ),
        array(
           	'class'=>'bootstrap.widgets.TbMenu',
           	'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'pills',
           	'items'=>array(
				array('label'=>'Login', 'url'=>Yii::app()->getModule('user')->loginUrl, 'visible'=>Yii::app()->user->isGuest),
          		array('label'=>'Register', 'url'=>Yii::app()->getModule('user')->registrationUrl, 'visible'=>Yii::app()->user->isGuest),
           	),
       	),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
            	
                array('label'=>Yii::app()->user->name, 'url'=>'#', 'visible' => !Yii::app()->user->isGuest, 'items'=>$menu),
            ),
        ),
    ),
)); ?>
<!--
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Settings"), 'visible'=>!Yii::app()->user->isGuest),
				array('url' => Yii::app()->getModule('message')->inboxUrl,
					'label' => 'Messages' .
					    (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ?
						' (' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . ')' :
						''),
					'visible' => !Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.' '.')', 'visible'=>!Yii::app()->user->isGuest),
				
				),
		)); 
		?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); echo "<br/>Exec ".Yii::getLogger()->getExecutionTime()." seconds"; ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
