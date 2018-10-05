<?php
/* @var $this PreferencesBrandsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preferences Brands',
);

$this->menu=array(
	array('label'=>'Create PreferencesBrands', 'url'=>array('create')),
	array('label'=>'Manage PreferencesBrands', 'url'=>array('admin')),
);
?>

<h1>Preferences Brands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
