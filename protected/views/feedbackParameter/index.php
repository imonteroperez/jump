<?php
/* @var $this FeedbackParameterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feedback Parameters',
);

$this->menu=array(
	array('label'=>'Create FeedbackParameter', 'url'=>array('create')),
	array('label'=>'Manage FeedbackParameter', 'url'=>array('admin')),
);
?>

<h1>Feedback Parameters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
