<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<!-- SCRIPT CHAIN DROPDOWNLIST RELATED -->
<script>
    function chainDropDown(){
        var category_id = $('#category_id').val();            
        $("#sub_category_id > option").remove();
            
        $.ajax({
            url:"<?php echo $this->createAbsoluteUrl('post/GetSubCategoryOptions'); ?>",
            data:'category_id='+category_id,
            type:'post',
            dataType:'json',
            success:function(data){
                $.each(data,function(id,name) 
                {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('#sub_category_id').append(opt);
                });
            }
        })
    }
    
    $(function(){           
        chainDropDown();
        
        $('#category_id').change(function(){
            chainDropDown();
        })
    })
</script>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'post-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'category_id'); ?>
        <?php echo $form->dropDownList($model, 'category_id', $this->getCategoryOptions(), array('id' => 'category_id', 'prompt' => 'Select Category')); ?>
        <?php
        echo CHtml::link('+', '#', array(
            'onclick' => '$("#categoryDialog").dialog("open"); return false;',
        ));
        ?>
        <?php echo $form->error($model, 'category_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sub_category_id'); ?>
        <?php echo $form->dropDownList($model, 'sub_category_id', array(), array('id' => 'sub_category_id')); ?>
        <?php
        echo CHtml::link('+', '#', array(
            'onclick' => '$("#subCategoryDialog").dialog("open"); return false;',
        ));
        ?>
        <?php echo $form->error($model, 'sub_category_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php
        $this->widget('ext.vlo.redactorjs.Redactor', array(
            'model' => $model,
            'attribute' => 'content',
            'editorOptions' => array(
                'imageUpload' => Yii::app()->createAbsoluteUrl('post/uploadRedactor/?type=image'),
                'imageGetJson' => Yii::app()->createAbsoluteUrl('post/uploadRedactor/1/?type=image'),
                'fileUpload' => Yii::app()->createAbsoluteUrl('post/uploadRedactor/?type=file'),
                'fileGetJson' => Yii::app()->createAbsoluteUrl('post/uploadRedactor/1/?type=file'),
            ),
        ));
        ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->dropDownList($model, 'active', $this->getActiveOptions()); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'hot'); ?>
        <?php echo $form->dropDownList($model, 'hot', $this->getHotOptions()); ?>
        <?php echo $form->error($model, 'hot'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image', array('size' => 60, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!-- CJui Dialog for creating category -->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'categoryDialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Add Category',
            'autoOpen' => false,
            'width' => 'auto'
        ),
    ));

    $this->renderPartial('/category/_form', array(
        'model' => $this->createCategory(),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

    <!-- CJui Dialog for creating subcategory -->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'subCategoryDialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Add Sub Category',
            'autoOpen' => false,
            'width' => 'auto'
        ),
    ));

    $this->renderPartial('/subCategory/_form', array(
        'model' => $this->createSubCategory(),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

</div><!-- form -->