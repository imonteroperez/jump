<?php
/* @var $this PreferencesBrandsController */
/* @var $model PreferencesBrands */

$this->breadcrumbs=array(
	'Preferences Brands'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PreferencesBrands', 'url'=>array('index')),
	array('label'=>'Create PreferencesBrands', 'url'=>array('create')),
	array('label'=>'View PreferencesBrands', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PreferencesBrands', 'url'=>array('admin')),
);
?>

<h1>Update PreferencesBrands <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>