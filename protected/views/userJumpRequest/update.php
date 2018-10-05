<?php
/* @var $this UserJumpRequestController */
/* @var $model UserJumpRequest */

$this->breadcrumbs=array(
	'User Jump Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserJumpRequest', 'url'=>array('index')),
	array('label'=>'Create UserJumpRequest', 'url'=>array('create')),
	array('label'=>'View UserJumpRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>Update UserJumpRequest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>