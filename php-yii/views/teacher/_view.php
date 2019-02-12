<?php
/* @var $this TeacherController */
/* @var $data Teacher */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacherId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->teacherId), array('view', 'id'=>$data->teacherId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacherNo')); ?>:</b>
	<?php echo CHtml::encode($data->teacherNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?php echo CHtml::encode($data->firstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastName')); ?>:</b>
	<?php echo CHtml::encode($data->lastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classCode')); ?>:</b>
	<?php echo CHtml::encode($data->classCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specialist')); ?>:</b>
	<?php echo CHtml::encode($data->specialist); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastUpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->lastUpdatedDate); ?>
	<br />

	*/ ?>

</div>