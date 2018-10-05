<?php
/* @var $this PreferencesCategoriesController */
/* @var $model PreferencesCategories */

$this->breadcrumbs=array(
	'Preferences Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PreferencesCategories', 'url'=>array('index')),
	array('label'=>'Manage PreferencesCategories', 'url'=>array('admin')),
);
?>

<h1>Create PreferencesCategories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>