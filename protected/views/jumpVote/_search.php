<?php
/* @var $this JumpVoteController */
/* @var $model JumpVote */
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
		<?php echo $form->label($model,'jump_request_id'); ?>
		<?php echo $form->textField($model,'jump_request_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'points'); ?>
		<?php echo $form->textField($model,'points'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desiredprice'); ?>
		<?php echo $form->textField($model,'desiredprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desiredlocation_lat'); ?>
		<?php echo $form->textField($model,'desiredlocation_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desiredlocation_long'); ?>
		<?php echo $form->textField($model,'desiredlocation_long'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->