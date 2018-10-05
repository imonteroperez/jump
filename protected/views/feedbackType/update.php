<?php
/* @var $this FeedbackTypeController */
/* @var $model FeedbackType */

$this->breadcrumbs=array(
	'Feedback Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FeedbackType', 'url'=>array('index')),
	array('label'=>'Create FeedbackType', 'url'=>array('create')),
	array('label'=>'View FeedbackType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FeedbackType', 'url'=>array('admin')),
);
?>

<h1>Update FeedbackType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>