<?php
/* @var $this ExternalSiteController */
/* @var $model ExternalSite */

$this->breadcrumbs=array(
	'External Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExternalSite', 'url'=>array('index')),
	array('label'=>'Create ExternalSite', 'url'=>array('create')),
	array('label'=>'View ExternalSite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExternalSite', 'url'=>array('admin')),
);
?>

<h1>Update ExternalSite <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>