<?php
/* @var $this SkillDescriptorController */
/* @var $data SkillDescriptor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('skillDescriptorId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->skillDescriptorId), array('view', 'id'=>$data->skillDescriptorId)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('subjectId')); ?>:</b>
    <?php echo CHtml::encode($data->subjectId); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('strandId')); ?>:</b>
    <?php echo CHtml::encode($data->strandId); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('levelId')); ?>:</b>
    <?php echo CHtml::encode($data->levelId); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('subStrandId')); ?>:</b>
	<?php echo CHtml::encode($data->subStrandId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sequenceNo')); ?>:</b>
	<?php echo CHtml::encode($data->sequenceNo); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ausvelsRef')); ?>:</b>
    <?php echo CHtml::encode($data->ausvelsRef); ?>
    <br />
 <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slp')); ?>:</b>
	<?php echo CHtml::encode($data->slp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('explanation')); ?>:</b>
	<?php echo CHtml::encode($data->explanation); ?>
	<br />
-->

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lastUpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->lastUpdatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frameworkId')); ?>:</b>
	<?php echo CHtml::encode($data->frameworkId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workSampleId')); ?>:</b>
	<?php echo CHtml::encode($data->workSampleId); ?>
	<br />

	*/ ?>

</div>