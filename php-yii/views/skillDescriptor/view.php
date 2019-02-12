<?php
/* @var $this SkillDescriptorController */
/* @var $model SkillDescriptor */

$this->breadcrumbs=array(
	'Skill Descriptors'=>array('index'),
	$model->skillDescriptorId,
);

$this->menu=array(
	array('label'=>'List Skill Descriptor', 'url'=>array('index')),
	array('label'=>'Create Skill Descriptor', 'url'=>array('create')),
	array('label'=>'Update Skill Descriptor', 'url'=>array('update', 'id'=>$model->skillDescriptorId)),
//	array('label'=>'Delete Skill Descriptor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->skillDescriptorId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Skill Descriptor', 'url'=>array('admin')),
);
?>

<h1>View Skill Descriptor #<?php echo $model->skillDescriptorId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'skillDescriptorId',
        'subjectId',
        'strandId',
        'levelId',
		'subStrandId',
		'sequenceNo',
        'ausvelsRef',
//      'description',
//      'slp',
//      'explanation',
//		'frameworkId',
//		'workSampleId',
	),
)); ?>
