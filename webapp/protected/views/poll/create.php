<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  'Create',
);

$this->menu=array(
  array('label'=>'List Polls', 'url'=>array('index')),
  array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1>Create Poll</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'choices'=>$choices)); ?>
