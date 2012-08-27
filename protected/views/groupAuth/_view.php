<?php
/* @var $this GroupAuthController */
/* @var $model GroupAuth */
?>

<div class="view">
	
	<?php echo CHtml::link('Delete', array('/groupAuth/delete', 'id'=>$data->id)); ?> | 
	<?php echo CHtml::link('Update', array('/groupAuth/update', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('className')); ?>:</b>
	<?php echo CHtml::encode($data->className); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />


</div>