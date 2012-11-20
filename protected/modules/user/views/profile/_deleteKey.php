<?php $form = $this->beginWidget( 'CActiveForm', array(
  'id' => 'location-delete-form',
  'enableAjaxValidation' => false,
  'focus' => '#denyDelete',
)); ?>
<p>You are about to delete the API key <strong><?php echo $key->keyID; ?></strong>. Deleting this key may cause some characters to loose access to some API calls, or may irreversibly delete characters altogether if this is the sole key they rely upon. For your convenience, listed below are the characters that may be affected by deleting this key.</p>

<ul>
<?php
$dp = new CArrayDataProvider($key->regCharacters(), array('keyField' => 'characterID'));
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dp,
    'itemView'=>'_keyDel_chars',   // refers to the partial view named '_post'
    'summaryText'=>false,
    'viewData'   =>array('key'=>$key),
));

?>
</ul>
<p>Are you sure you wish to delete the key <strong><?php echo $key->keyID; ?></strong>?</p>

<div class="btn-toolbar">
 
  <?php
if (!Yii::app()->request->isAjaxRequest) {
  $this->widget( 'bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'danger',
    'label' => 'Delete',
    'htmlOptions' => array('name'=> 'confirmDelete',),
  ));
    $this->widget( 'bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => '',
    'label' => 'Cancel',
    'htmlOptions' => array('name'=> 'denyDelete',),
  ));
}
  ?>
</div>
 
<?php $this->endWidget(); ?>