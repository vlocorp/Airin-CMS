<?php
/* @var $this GroupAuthController */
/* @var $model GroupAuth */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-auth-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'className'); ?>
		<?php echo $form->textField($model,'className',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'className'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->