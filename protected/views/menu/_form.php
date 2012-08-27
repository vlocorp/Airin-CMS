<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php if(isset($children_id)):?>
        <input type="hidden" name="Menu[children_id]" value="<?php echo $children_id;?>"/>
        <?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->