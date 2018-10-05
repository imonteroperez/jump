<?php
/* @var $this UserBadgeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Badges',
);

$this->menu=array(
	array('label'=>'Create UserBadge', 'url'=>array('create')),
	array('label'=>'Manage UserBadge', 'url'=>array('admin')),
);
?>

<h1>User Badges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
