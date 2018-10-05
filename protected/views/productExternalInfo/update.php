<?php
/* @var $this ProductExternalInfoController */
/* @var $model ProductExternalInfo */

$this->breadcrumbs=array(
	'Product External Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductExternalInfo', 'url'=>array('index')),
	array('label'=>'Create ProductExternalInfo', 'url'=>array('create')),
	array('label'=>'View ProductExternalInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductExternalInfo', 'url'=>array('admin')),
);
?>

<h1>Update ProductExternalInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>