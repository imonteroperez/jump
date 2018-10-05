<?php
/* @var $this UserBadgeController */
/* @var $model UserBadge */

$this->breadcrumbs=array(
	'User Badges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserBadge', 'url'=>array('index')),
	array('label'=>'Create UserBadge', 'url'=>array('create')),
	array('label'=>'Update UserBadge', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserBadge', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserBadge', 'url'=>array('admin')),
);
?>

<h1>View UserBadge #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'badge_id',
	),
)); ?>
