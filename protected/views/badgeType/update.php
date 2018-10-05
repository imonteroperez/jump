<?php
/* @var $this BadgeTypeController */
/* @var $model BadgeType */

$this->breadcrumbs=array(
	'Badge Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BadgeType', 'url'=>array('index')),
	array('label'=>'Create BadgeType', 'url'=>array('create')),
	array('label'=>'View BadgeType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BadgeType', 'url'=>array('admin')),
);
?>

<h1>Update BadgeType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>