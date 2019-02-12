<?php
/* @var $this SkillDescriptorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Skill Descriptors',
);

$this->menu=array(
	array('label'=>'Create Skill Descriptor', 'url'=>array('create')),
	array('label'=>'Manage Skill Descriptor', 'url'=>array('admin')),
);
?>

<h1>Skill Descriptors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
