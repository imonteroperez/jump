<?php
/* @var $this JumpResponseTypeController */
/* @var $model JumpResponseType */

$this->breadcrumbs=array(
	'Jump Response Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JumpResponseType', 'url'=>array('index')),
	array('label'=>'Manage JumpResponseType', 'url'=>array('admin')),
);
?>

<h1>Create JumpResponseType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>