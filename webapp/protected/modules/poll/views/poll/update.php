<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  $model->title=>array('view','id'=>$model->id),
  'Update',
);

$this->menu=array(
  array('label'=>'List Polls', 'url'=>array('index')),
  array('label'=>'Create Poll', 'url'=>array('create')),
  array('label'=>'View Poll', 'url'=>array('view', 'id'=>$model->id)),
  array('label'=>'Export Poll', 'url'=>array('export', 'id'=>$model->id)),
  array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1>Update Poll: <?php echo CHtml::encode($model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'choices'=>$choices)); ?>
