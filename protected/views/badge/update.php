<?php
/* @var $this BadgeController */
/* @var $model Badge */

$this->breadcrumbs=array(
	'Badges'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Badge', 'url'=>array('index')),
	array('label'=>'Create Badge', 'url'=>array('create')),
	array('label'=>'View Badge', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Badge', 'url'=>array('admin')),
);
?>

<h1>Update Badge <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>