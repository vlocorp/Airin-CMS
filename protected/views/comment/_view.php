<?php
/* @var $this CommentController */
/* @var $model Comment */
?>

<div class="view">	
        
        <!-- SHOW USERNAME IF IT'S USER COMMENT -->
        <?php if($data->user_id):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />
        
        <!-- SHOW NAME AND WEBSITE LINK IF IT'S NON USER COMMENT -->
        <?php else:?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link($data->name, $data->website, array('target'=>'_blank')); ?>
	<br />
        <?php endif;?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>