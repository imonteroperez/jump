<?php
/* @var $this ProductUserJumpRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product User Jump Requests',
);

$this->menu=array(
	array('label'=>'Create ProductUserJumpRequest', 'url'=>array('create')),
	array('label'=>'Manage ProductUserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>Product User Jump Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
