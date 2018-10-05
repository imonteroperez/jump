<?php
/* @var $this JumpRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jump Requests',
);

$this->menu=array(
	array('label'=>'Create JumpRequest', 'url'=>array('create')),
	array('label'=>'Manage JumpRequest', 'url'=>array('admin')),
);
?>

<h1>Jump Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
