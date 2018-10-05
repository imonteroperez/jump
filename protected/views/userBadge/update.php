<?php
/* @var $this UserBadgeController */
/* @var $model UserBadge */

$this->breadcrumbs=array(
	'User Badges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserBadge', 'url'=>array('index')),
	array('label'=>'Create UserBadge', 'url'=>array('create')),
	array('label'=>'View UserBadge', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserBadge', 'url'=>array('admin')),
);
?>

<h1>Update UserBadge <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>