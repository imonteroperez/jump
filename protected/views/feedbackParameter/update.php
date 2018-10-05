<?php
/* @var $this FeedbackParameterController */
/* @var $model FeedbackParameter */

$this->breadcrumbs=array(
	'Feedback Parameters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FeedbackParameter', 'url'=>array('index')),
	array('label'=>'Create FeedbackParameter', 'url'=>array('create')),
	array('label'=>'View FeedbackParameter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FeedbackParameter', 'url'=>array('admin')),
);
?>

<h1>Update FeedbackParameter <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>