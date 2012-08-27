<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs = array(
    'Menus' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Menu', 'url' => array('index')),
    array('label' => 'Create Menu', 'url' => array('create')),
    array('label' => 'Update Menu', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Menu', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Menu', 'url' => array('admin')),
);
?>

<h1>View Menu #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'link',
    ),
));
?>

<h2>Create Sub Menu</h2>
<?php
$this->renderPartial('_form', array(
    'model' => $this->createChild(),
    'children_id' => $model->id,
));
?>

<h2>List Sub Menu</h2>
<!-- FIRST CHILD -->
<?php foreach ($this->getChild($model->id) as $children): ?>
    <div class="view">        
        <b><?php echo $children->title; ?></b>
        <?php echo CHtml::link('Delete',"#", array("submit"=>array('delete', 'id'=>$children->id), 'confirm' => 'Are you sure?')); ?> | 
        <?php echo CHtml::link('Update', array('Menu/update/'.$children->id)); ?>
        <?php
        $this->renderPartial('_form', array(
            'model' => $this->createChild(),
            'children_id' => $children->id,
        ));
        ?>

        <!-- SECOND CHILD -->    
        <?php foreach ($this->getChild($children->id) as $children): ?>
            <div class="view">
                <b><?php echo $children->title; ?></b>
                <?php echo CHtml::link('Delete',"#", array("submit"=>array('delete', 'id'=>$children->id), 'confirm' => 'Are you sure?')); ?> | 
                <?php echo CHtml::link('Update', array('Menu/update/'.$children->id)); ?>
                <?php
                $this->renderPartial('_form', array(
                    'model' => $this->createChild(),
                    'children_id' => $children->id,
                ));
                ?>

                <!-- THIRD CHILD -->
                <?php foreach ($this->getChild($children->id) as $children): ?>
                    <div class="view">
                        <b><?php echo $children->title; ?></b>
                        <?php echo CHtml::link('Delete',"#", array("submit"=>array('delete', 'id'=>$children->id), 'confirm' => 'Are you sure?')); ?> | 
                        <?php echo CHtml::link('Update', array('Menu/update/'.$children->id)); ?>
                        <?php
                        $this->renderPartial('_form', array(
                            'model' => $this->createChild(),
                            'children_id' => $children->id,
                        ));
                        ?>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>

    </div>
<?php endforeach; ?>

<h2>Menu Preview</h2>
<?php $this->widget('ext.vlo.menu.Vmenu');?>


