<?php
/* @var $this BadgeTypeController */
/* @var $model BadgeType */

$this->breadcrumbs=array(
	'Badge Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BadgeType', 'url'=>array('index')),
	array('label'=>'Create BadgeType', 'url'=>array('create')),
	array('label'=>'Update BadgeType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BadgeType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BadgeType', 'url'=>array('admin')),
);
?>

<h1>View BadgeType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
