<?php
/* @var $this SkillDescriptorController */
/* @var $model SkillDescriptor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'skillDescriptorId'); ?>
		<?php echo $form->textField($model,'skillDescriptorId',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subStrandId'); ?>
		<?php echo $form->textField($model,'subStrandId',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'levelId'); ?>
		<?php echo $form->textField($model,'levelId',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sequenceNo'); ?>
		<?php echo $form->textField($model,'sequenceNo'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'ausvelsRef'); ?>
        <?php echo $form->textField($model,'ausvelsRef'); ?>
    </div>

<!--
	<div class="row">
		<?php //echo $form->label($model,'frameworkId'); ?>
		<?php //echo $form->textField($model,'frameworkId',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'workSampleId'); ?>
		<?php //echo $form->textField($model,'workSampleId',array('size'=>10,'maxlength'=>10)); ?>
	</div>
-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->