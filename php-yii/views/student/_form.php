<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'casesId'); ?>
		<?php echo $form->textField($model,'casesId',array('size'=>10,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'casesId'); ?>
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
		<?php echo $form->labelEx($model,'preferredName'); ?>
		<?php echo $form->textField($model,'preferredName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'preferredName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthDate'); ?>
		<?php echo $form->textField($model,'birthDate',array('class'=>'dtinput')); ?>
		<?php echo $form->error($model,'birthDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
        <?php echo $form->radioButtonList($model,'gender',Yii::app()->constants->getGenderOptions(),array(
            'labelOptions'=>array('class'=>'rblabel'),
            'separator'=>'',
        )); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'homeGroup'); ?>
        <?php echo $form->textField($model,'homeGroup',array('size'=>5,'maxlength'=>3)); ?>
        <?php echo $form->error($model,'homeGroup'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->