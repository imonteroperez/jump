<?php
/* @var $this ShopController */
/* @var $model Shop */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geolocation_lat'); ?>
		<?php echo $form->textField($model,'geolocation_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geolocation_long'); ?>
		<?php echo $form->textField($model,'geolocation_long'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->