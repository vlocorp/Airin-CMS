<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'category_id',
		'sub_category_id',
		'title',
		'content',
		'hide',
		'active',
		'sort',
		'hot',
		'image',
		'create_time',
		'update_time',
	),
)); ?>

<br/>

<h3>Add Comment</h3>
<?php $this->renderPartial('/comment/_form', array(
    'model'=>$createComment,
));?>   

<h3>List Comment</h3>
<?php $this->widget('zii.widgets.CListView',array(
        'dataProvider'=>$commentDataProvider,
        'itemView'=>'/comment/_view',
));?>
