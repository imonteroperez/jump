<?php
/* @var $this ExternalSiteController */
/* @var $model ExternalSite */

$this->breadcrumbs=array(
	'External Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExternalSite', 'url'=>array('index')),
	array('label'=>'Manage ExternalSite', 'url'=>array('admin')),
);
?>

<h1>Create ExternalSite</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>