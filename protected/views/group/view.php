<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Update Group', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<h1>View Group #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
<br/>
<br/>

<h2>Create Group Auth</h2>
<?php $this->renderPartial('/groupAuth/_form', array(
    'model'=>$createGroupAuth,
));?>

<h2>List Group Auth</h2>
<?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$groupAuthDataProvider,
        'itemView'=>'/groupAuth/_view',
));?>
