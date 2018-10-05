<?php
/* @var $this PreferencesBrandsController */
/* @var $model PreferencesBrands */

$this->breadcrumbs=array(
	'Preferences Brands'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PreferencesBrands', 'url'=>array('index')),
	array('label'=>'Create PreferencesBrands', 'url'=>array('create')),
	array('label'=>'Update PreferencesBrands', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PreferencesBrands', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PreferencesBrands', 'url'=>array('admin')),
);
?>

<h1>View PreferencesBrands #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'brand_id',
		'count',
	),
)); ?>
