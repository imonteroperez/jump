<?php
/* @var $this FeedbackParameterController */
/* @var $model FeedbackParameter */

$this->breadcrumbs=array(
	'Feedback Parameters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FeedbackParameter', 'url'=>array('index')),
	array('label'=>'Create FeedbackParameter', 'url'=>array('create')),
	array('label'=>'Update FeedbackParameter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FeedbackParameter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FeedbackParameter', 'url'=>array('admin')),
);
?>

<h1>View FeedbackParameter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
