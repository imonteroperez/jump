<?php
/* @var $this PreferencesCategoriesController */
/* @var $model PreferencesCategories */

$this->breadcrumbs=array(
	'Preferences Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PreferencesCategories', 'url'=>array('index')),
	array('label'=>'Create PreferencesCategories', 'url'=>array('create')),
	array('label'=>'Update PreferencesCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PreferencesCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PreferencesCategories', 'url'=>array('admin')),
);
?>

<h1>View PreferencesCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'category_id',
		'maxprice',
		'count',
	),
)); ?>
