<?php
/* @var $this BadgeTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Badge Types',
);

$this->menu=array(
	array('label'=>'Create BadgeType', 'url'=>array('create')),
	array('label'=>'Manage BadgeType', 'url'=>array('admin')),
);
?>

<h1>Badge Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
