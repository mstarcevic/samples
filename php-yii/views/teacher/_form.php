<?php
/* @var $this TeacherController */
/* @var $model Teacher */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teacher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'teacherNo'); ?>
		<?php echo $form->textField($model,'teacherNo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'teacherNo'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'classCode'); ?>
		<?php echo $form->textField($model,'classCode',array('size'=>5,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'classCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialist'); ?>
		<?php echo $form->checkBox($model,'specialist',array('value'=>1,'uncheckValue'=>0)); ?>
		<?php echo $form->error($model,'specialist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->