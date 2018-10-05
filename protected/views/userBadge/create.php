<?php
/* @var $this UserBadgeController */
/* @var $model UserBadge */

$this->breadcrumbs=array(
	'User Badges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserBadge', 'url'=>array('index')),
	array('label'=>'Manage UserBadge', 'url'=>array('admin')),
);
?>

<h1>Create UserBadge</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>