<?php
/* @var $this FeedbackTypeController */
/* @var $model FeedbackType */

$this->breadcrumbs=array(
	'Feedback Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FeedbackType', 'url'=>array('index')),
	array('label'=>'Manage FeedbackType', 'url'=>array('admin')),
);
?>

<h1>Create FeedbackType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>