<?php
/* @var $this UserJumpRequestController */
/* @var $model UserJumpRequest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-jump-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jump_request_id'); ?>
		<?php echo $form->textField($model,'jump_request_id'); ?>
		<?php echo $form->error($model,'jump_request_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_jump'); ?>
		<?php echo $form->textField($model,'is_jump'); ?>
		<?php echo $form->error($model,'is_jump'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->