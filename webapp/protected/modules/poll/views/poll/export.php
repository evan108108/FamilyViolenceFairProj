<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  $model->title,
);

$this->menu=array(
  array('label'=>'List Polls', 'url'=>array('index')),
  array('label'=>'Create Poll', 'url'=>array('create')),
  array('label'=>'View Poll', 'url'=>array('view', 'id'=>$model->id)),
  array('label'=>'Update Poll', 'url'=>array('update', 'id'=>$model->id)),
  array('label'=>'Delete Poll', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1>Export <em><?php echo CHtml::encode($model->title); ?></em> Results</h1>

<div class="form">
  <?php echo $cform->render(); ?>
</div>
