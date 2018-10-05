<?php
/* @var $this FeedbackTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feedback Types',
);

$this->menu=array(
	array('label'=>'Create FeedbackType', 'url'=>array('create')),
	array('label'=>'Manage FeedbackType', 'url'=>array('admin')),
);
?>

<h1>Feedback Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
