<?php
/* @var $this FeedbackTypeController */
/* @var $model FeedbackType */

$this->breadcrumbs=array(
	'Feedback Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FeedbackType', 'url'=>array('index')),
	array('label'=>'Create FeedbackType', 'url'=>array('create')),
	array('label'=>'Update FeedbackType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FeedbackType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FeedbackType', 'url'=>array('admin')),
);
?>

<h1>View FeedbackType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
