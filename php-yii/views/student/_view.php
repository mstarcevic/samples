<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('studentId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->studentId), array('view', 'id'=>$data->studentId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('casesId')); ?>:</b>
	<?php echo CHtml::encode($data->casesId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?php echo CHtml::encode($data->firstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastName')); ?>:</b>
	<?php echo CHtml::encode($data->lastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preferredName')); ?>:</b>
	<?php echo CHtml::encode($data->preferredName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthDate')); ?>:</b>
	<?php echo CHtml::encode($data->birthDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('homeGroup')); ?>:</b>
    <?php echo CHtml::encode($data->homeGroup); ?>
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