<?php
/* @var $this SkillDescriptorController */
/* @var $model SkillDescriptor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'skill-descriptor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'subjectId'); ?>
        <?php echo $form->dropDownList($model,'subjectId',CHtml::listData(Subject::model()->findAll(),'subjectId','name'),
            array(
                'prompt'=>'Select subject',
                'ajax'=>array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('loadStrands'),
                    'data'=>array('subjectId'=>'js:this.value'),
                    'update'=>'#'.CHtml::activeId($model,'strandId'),
                    'complete'=>'function(){
                        $("#'.CHtml::activeId($model,"levelId").'").children("option:not(:first)").remove();
                        $("#'.CHtml::activeId($model,"subStrandId").'").children("option:not(:first)").remove();
                    }',
                ))); ?>
        <?php echo $form->error($model,'subjectId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'strandId'); ?>
        <?php echo $form->dropDownList($model,'strandId',CHtml::listData(Strand::model()->findAll('subjectId=:subjectId',
            array(':subjectId'=>$model->subjectId)),'strandId','name'),
            array(
                'prompt'=>'Select strand',
                'ajax'=>array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('loadLevelsAndSubStrands'),
                    'data'=>array('strandId'=>'js:this.value'),
                    'dataType'=>'json',
                    'success'=>'function(data){
                        $("#'.CHtml::activeId($model,"levelId").'").html(data.dropDownLevels);
                        $("#'.CHtml::activeId($model,"subStrandId").'").html(data.dropDownSubStrands);
                    }',
                )));  ?>
        <?php echo $form->error($model,'strandId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'levelId'); ?>
        <?php echo $form->dropDownList($model,'levelId',CHtml::listData(Level::model()->findAll('strandId=:strandId',
            array(':strandId'=>$model->strandId)),'levelId','levelCode'),
            array('prompt'=>'Select Level')
        ); ?>
        <?php echo $form->error($model,'levelId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'subStrandId'); ?>
        <?php echo $form->dropDownList($model,'subStrandId',CHtml::listData(SubStrand::model()->findAll('strandId=:strandId',
            array(':strandId'=>$model->strandId)),'subStrandId','name'),
            array('prompt'=>'Select Sub Strand')
        ); ?>
		<?php echo $form->error($model,'subStrandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sequenceNo'); ?>
		<?php echo $form->textField($model,'sequenceNo'); ?>
		<?php echo $form->error($model,'sequenceNo'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'ausvelsRef'); ?>
        <?php echo $form->textField($model,'ausvelsRef'); ?>
        <?php echo $form->error($model,'ausvelsRef'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slp'); ?>
		<?php echo $form->checkBox($model,'slp'); ?>
		<?php echo $form->error($model,'slp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'explanation'); ?>
		<?php echo $form->textArea($model,'explanation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'explanation'); ?>
	</div>

<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'frameworkId'); ?>
		<?php //echo $form->textField($model,'frameworkId',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'frameworkId'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'workSampleId'); ?>
		<?php //echo $form->textField($model,'workSampleId',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'workSampleId'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->