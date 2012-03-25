<?php
$this->breadcrumbs=array(
  'Polls',
);

$this->menu=array(
  array('label'=>'Create Poll', 'url'=>array('create')),
  array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1>Polls</h1>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
