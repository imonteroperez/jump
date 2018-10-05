<?php
/* @var $this JumpRequestController */
/* @var $model JumpRequest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jump-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'votes'); ?>
		<?php echo $form->textField($model,'votes'); ?>
		<?php echo $form->error($model,'votes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_id'); ?>
		<?php echo $form->textField($model,'author_id'); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desiredprice'); ?>
		<?php echo $form->textField($model,'desiredprice'); ?>
		<?php echo $form->error($model,'desiredprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'averagedprice'); ?>
		<?php echo $form->textField($model,'averagedprice'); ?>
		<?php echo $form->error($model,'averagedprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_id'); ?>
		<?php echo $form->textField($model,'photo_id'); ?>
		<?php echo $form->error($model,'photo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geoposition_lat'); ?>
		<?php echo $form->textField($model,'geoposition_lat'); ?>
		<?php echo $form->error($model,'geoposition_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geoposition_long'); ?>
		<?php echo $form->textField($model,'geoposition_long'); ?>
		<?php echo $form->error($model,'geoposition_long'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'points'); ?>
		<?php echo $form->textField($model,'points'); ?>
		<?php echo $form->error($model,'points'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->