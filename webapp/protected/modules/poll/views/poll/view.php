<?php
$this->breadcrumbs=array(
  'Polls'=>array('index'),
  $model->title,
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

<h1><?php echo CHtml::encode($model->title); ?></h1>

<?php if ($model->description): ?>
<p class="description"><?php echo CHtml::encode($model->description); ?></p>
<?php endif; ?>

<?php $this->renderPartial('_results', array('model' => $model)); ?>

<?php if ($userVote->id): ?>
  <p id="pollvote-<?php echo $userVote->id ?>">
    You voted: <strong><?php echo $userChoice->label ?></strong>.<br />
    <?php
      if ($userCanCancel) {
        echo CHtml::ajaxLink(
          'Cancel Vote',
          array('/poll/pollvote/delete', 'id' => $userVote->id, 'ajax' => TRUE),
          array(
            'type' => 'POST',
            'success' => 'js:function(){window.location.reload();}',
          ),
          array(
            'class' => 'cancel-vote',
            'confirm' => 'Are you sure you want to cancel your vote?'
          )
        );
      }
    ?>
  </p>
<?php else: ?>
  <p><?php echo CHtml::link('Vote', array('/poll/poll/vote', 'id' => $model->id)); ?></p>
<?php endif; ?>
