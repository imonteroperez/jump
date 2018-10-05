<?php
/* @var $this JumpVoteController */
/* @var $model JumpVote */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jump-vote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'jump_request_id'); ?>
		<?php echo $form->textField($model,'jump_request_id'); ?>
		<?php echo $form->error($model,'jump_request_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'points'); ?>
		<?php echo $form->textField($model,'points'); ?>
		<?php echo $form->error($model,'points'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desiredprice'); ?>
		<?php echo $form->textField($model,'desiredprice'); ?>
		<?php echo $form->error($model,'desiredprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desiredlocation_lat'); ?>
		<?php echo $form->textField($model,'desiredlocation_lat'); ?>
		<?php echo $form->error($model,'desiredlocation_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desiredlocation_long'); ?>
		<?php echo $form->textField($model,'desiredlocation_long'); ?>
		<?php echo $form->error($model,'desiredlocation_long'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->