<?php
/* @var $this PreferencesBrandsController */
/* @var $model PreferencesBrands */

$this->breadcrumbs=array(
	'Preferences Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PreferencesBrands', 'url'=>array('index')),
	array('label'=>'Manage PreferencesBrands', 'url'=>array('admin')),
);
?>

<h1>Create PreferencesBrands</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>