<?php
/* @var $this JumpResponseTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jump Response Types',
);

$this->menu=array(
	array('label'=>'Create JumpResponseType', 'url'=>array('create')),
	array('label'=>'Manage JumpResponseType', 'url'=>array('admin')),
);
?>

<h1>Jump Response Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
