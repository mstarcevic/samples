<?php
/* @var $this TeacherController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Update Teacher', 'url'=>array('update', 'id'=>$model->teacherId)),
//	array('label'=>'Delete Teacher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->teacherId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>View Teacher #<?php echo $model->teacherId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'teacherId',
		'teacherNo',
		'firstName',
		'lastName',
		'title',
		'classCode',
		'specialist',
	),
)); ?>
