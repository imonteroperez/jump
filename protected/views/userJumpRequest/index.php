<?php
/* @var $this UserJumpRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Jump Requests',
);

$this->menu=array(
	array('label'=>'Create UserJumpRequest', 'url'=>array('create')),
	array('label'=>'Manage UserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>User Jump Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
