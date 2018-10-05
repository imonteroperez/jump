<?php
/* @var $this JumpRequestController */
/* @var $model JumpRequest */

$this->breadcrumbs=array(
	'Jump Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JumpRequest', 'url'=>array('index')),
	array('label'=>'Create JumpRequest', 'url'=>array('create')),
	array('label'=>'View JumpRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JumpRequest', 'url'=>array('admin')),
);
?>

<h1>Update JumpRequest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>