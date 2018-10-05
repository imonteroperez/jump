<?php
/* @var $this PreferencesCategoriesController */
/* @var $model PreferencesCategories */

$this->breadcrumbs=array(
	'Preferences Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PreferencesCategories', 'url'=>array('index')),
	array('label'=>'Create PreferencesCategories', 'url'=>array('create')),
	array('label'=>'View PreferencesCategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PreferencesCategories', 'url'=>array('admin')),
);
?>

<h1>Update PreferencesCategories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>