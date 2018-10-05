<?php
/* @var $this ExternalSiteController */
/* @var $model ExternalSite */
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
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'source'); ?>
        <?php echo $form->textField($model,'source'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'brand_id'); ?>
        <?php echo $form->textField($model,'brand_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'shop_id'); ?>
        <?php echo $form->textField($model,'shop_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
