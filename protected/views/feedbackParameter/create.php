<?php
/* @var $this FeedbackParameterController */
/* @var $model FeedbackParameter */

$this->breadcrumbs=array(
	'Feedback Parameters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FeedbackParameter', 'url'=>array('index')),
	array('label'=>'Manage FeedbackParameter', 'url'=>array('admin')),
);
?>

<h1>Create FeedbackParameter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>