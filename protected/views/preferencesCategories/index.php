<?php
/* @var $this PreferencesCategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preferences Categories',
);

$this->menu=array(
	array('label'=>'Create PreferencesCategories', 'url'=>array('create')),
	array('label'=>'Manage PreferencesCategories', 'url'=>array('admin')),
);
?>

<h1>Preferences Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
