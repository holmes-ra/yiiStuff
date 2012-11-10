<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<pre>
<?php 

echo Yii::app()->user->name;
var_dump(Yii::app()->user->isCharacter);
if (Yii::app()->user->isCharacter) {
	echo Yii::app()->user->charID;
}


$this->widget('bootstrap.widgets.TbCarousel', array(
  'items'=>array(
      array(
		'image'=>'http://placehold.it/830x400&text=First+thumbnail',
		'label'=>'First Thumbnail label',
		'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. ' .
			'Donec id elit non mi porta gravida at eget metus. ' .
			'Nullam id dolor id nibh ultricies vehicula ut id elit.'),
      array(
		'image'=>'http://placehold.it/830x400&text=Second+thumbnail',
		'label'=>'Second Thumbnail label',
		'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. ' .
			'Donec id elit non mi porta gravida at eget metus. ' .
			'Nullam id dolor id nibh ultricies vehicula ut id elit.'),
      array(
		'image'=>'http://placehold.it/830x400&text=Third+thumbnail',
		'label'=>'Third Thumbnail label',
		'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. ' .
			'Donec id elit non mi porta gravida at eget metus. ' .
			'Nullam id dolor id nibh ultricies vehicula ut id elit.'),
  ),
));

print_r(Yii::app()->user);

?>
</pre>

<h3>ToDo</h3>

<ul>
	<li>Finish basic registration: email, api keys, no character. Create relations on the way. Make sure key anc vcode validation happens even though user class might not allow for it</li>
	<li>Find out how to fetch data from API - keep 1 registration controller / class / whatever</li>
	<li>Apply fetch data to reg form</li>
	<li>prettyfy</li>
	<li>complete ajaxy reg box thing (make reg form widget and include?)</li>
	<li>work on profile, including selecting which characters to pull from and specific APIs</li>
	<li>Move character actions to centralized character controller</li>
</ul>


<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
