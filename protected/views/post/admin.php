<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('post-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Posts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
                'id',
		array(
                    'header'=>'User',
                    'filter'=>  CHtml::listData(User::model()->findAll(), 'id', 'username'),
                    'name'=>'user_id',
                    'value'=>'$data->user->username'
                ),
		array(
                    'header'=>'Category',
                    'filter'=>  CHtml::listData(Category::model()->findAll(), 'id', 'name'),
                    'name'=>'category_id',
                    'value'=>'$data->category->name'
                ),		
		array(
                    'header'=>'Sub Category',
                    'filter'=>  CHtml::listData(SubCategory::model()->findAll(), 'id', 'name'),
                    'name'=>'sub_category_id',
                    'value'=>'isset($data->subCategory->name)?$data->subCategory->name:"Null"'
                ),				
		'title',
                array(
                    'header'=>'Active',
                    'filter'=>  array('1'=>'Yes','0'=>'No'),
                    'name'=>'active',
                    'value'=>'($data->active==1)?"Yes":"No"'
                ),				
                array(
                    'header'=>'Hot',
                    'filter'=>  array('1'=>'Yes','0'=>'No'),
                    'name'=>'hot',
                    'value'=>'($data->hot==1)?"Yes":"No"'
                ),				                				
		/*
		'hide',
		'active',
		'sort',
		'hot',
		'image',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{update}{delete}{view}{active}{hot}',
                        'buttons'=>array(
                            'active'=>array(
                                'label'=>'active',
                                'url'=>'Yii::app()->createUrl("post/setActive", array("id"=>$data->id))',                                
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/visible.png'                                
                            ),
                            'hot'=>array(
                                'label'=>'hot',
                                'url'=>'Yii::app()->createUrl("post/setHot", array("id"=>$data->id))',                                
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/hot2.png'                                
                            ),
                        ),                        
		),
	),
)); ?>
