<div class="view poll-item">

  <div class="poll-id">
    #<?php echo CHtml::encode($data->id); ?>
  </div>

  <strong><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></strong>

  <p class="description"><?php echo CHtml::encode($data->description); ?></p>

</div>
