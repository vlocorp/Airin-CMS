<?php
/* @var $this PostController */
/* @var $model Post */
?>

<div class="view">
    <div class="post">
        <h3 class="post-title">  <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?></h3>
        <h3 class="post-meta"><?php echo CHtml::encode($data->update_time); ?> / <a href="#">No Comments &#187;</a></h3>
        <img width="200"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/post/<?php echo CHtml::encode($data->image); ?>" class="post-image" alt="" />
        <p><?php echo $data->content, 0, 200 ?> ...
            <!--            <a href="#" class="more-link">Read Full Post &raquo;</a>-->
            <?php echo CHtml::link('Read Full Post &raquo;', array('view', 'id' => $data->id), array('class' => 'more-link')); ?>
        </p>
    </div>
    <div class="post-line"></div>
    <!--end post-->
<!--    <b><?php // echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php // echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php // echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
    <?php // echo CHtml::encode($data->category_id); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('sub_category_id')); ?>:</b>
    <?php // echo CHtml::encode($data->sub_category_id); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php // echo CHtml::encode($data->title); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
    <?php // echo CHtml::encode($data->content); ?>
    <br />

    <b><?php // echo CHtml::encode($data->getAttributeLabel('hide')); ?>:</b>
    <?php // echo CHtml::encode($data->hide); ?>
    <br />-->

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
      <?php echo CHtml::encode($data->active); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
      <?php echo CHtml::encode($data->sort); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('hot')); ?>:</b>
      <?php echo CHtml::encode($data->hot); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
      <?php echo CHtml::encode($data->image); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
      <?php echo CHtml::encode($data->create_time); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
      <?php echo CHtml::encode($data->update_time); ?>
      <br />

     */ ?>

</div>