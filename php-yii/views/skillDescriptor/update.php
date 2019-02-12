<?php
/* @var $this SkillDescriptorController */
/* @var $model SkillDescriptor */

$this->breadcrumbs=array(
	'Skill Descriptors'=>array('index'),
	$model->skillDescriptorId=>array('view','id'=>$model->skillDescriptorId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Skill Descriptor', 'url'=>array('index')),
	array('label'=>'Create Skill Descriptor', 'url'=>array('create')),
	array('label'=>'View Skill Descriptor', 'url'=>array('view', 'id'=>$model->skillDescriptorId)),
	array('label'=>'Manage Skill Descriptor', 'url'=>array('admin')),
);
?>

<h1>Update Skill Descriptor <?php echo $model->skillDescriptorId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>