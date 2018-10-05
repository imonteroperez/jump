<?php
/* @var $this ExternalInfoController */
/* @var $model ExternalInfo */

$this->breadcrumbs=array(
	'External Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExternalInfo', 'url'=>array('index')),
	array('label'=>'Create ExternalInfo', 'url'=>array('create')),
	array('label'=>'View ExternalInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExternalInfo', 'url'=>array('admin')),
);
?>

<h1>Update ExternalInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>