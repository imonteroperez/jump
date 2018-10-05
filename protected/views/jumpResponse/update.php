<?php
/* @var $this JumpResponseController */
/* @var $model JumpResponse */

$this->breadcrumbs=array(
	'Jump Responses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JumpResponse', 'url'=>array('index')),
	array('label'=>'Create JumpResponse', 'url'=>array('create')),
	array('label'=>'View JumpResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JumpResponse', 'url'=>array('admin')),
);
?>

<h1>Update JumpResponse <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>