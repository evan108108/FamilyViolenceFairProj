<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  $model->title=>array('view','id'=>$model->id),
);

$this->menu=array(
  array('label'=>'List Polls', 'url'=>array('index')),
  array('label'=>'Create Poll', 'url'=>array('create')),
  array('label'=>'Update Poll', 'url'=>array('update', 'id'=>$model->id)),
  array('label'=>'Export Poll', 'url'=>array('export', 'id'=>$model->id)),
  array('label'=>'Delete Poll', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title) ?></h1>

<?php echo $this->renderPartial('_vote', array('model'=>$model,'vote'=>$vote,'choices'=>$choices)); ?>
