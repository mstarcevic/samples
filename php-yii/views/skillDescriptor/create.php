<?php
/* @var $this SkillDescriptorController */
/* @var $model SkillDescriptor */

$this->breadcrumbs=array(
	'Skill Descriptors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Skill Descriptor', 'url'=>array('index')),
	array('label'=>'Manage Skill Descriptor', 'url'=>array('admin')),
);
?>

<h1>Create Skill Descriptor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>