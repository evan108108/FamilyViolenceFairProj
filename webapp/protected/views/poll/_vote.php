<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'poll-form',
  'enableAjaxValidation'=>false,
)); ?>

  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($vote,'choice_id'); ?>
    <?php $template = '<div class="row-choice clearfix"><div class="form-radio">{input}</div><div class="form-label">{label}</div></div>'; ?>
    <?php echo $form->radioButtonList($vote,'choice_id',$choices,array('template'=>$template,'separator'=>'')); ?>
    <?php echo $form->error($vote,'choice_id'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Vote'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
