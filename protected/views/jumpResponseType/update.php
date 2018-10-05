<?php
/* @var $this JumpResponseTypeController */
/* @var $model JumpResponseType */

$this->breadcrumbs=array(
	'Jump Response Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JumpResponseType', 'url'=>array('index')),
	array('label'=>'Create JumpResponseType', 'url'=>array('create')),
	array('label'=>'View JumpResponseType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JumpResponseType', 'url'=>array('admin')),
);
?>

<h1>Update JumpResponseType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>