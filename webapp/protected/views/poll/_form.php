<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'poll-form',
  //'enableAjaxValidation'=>TRUE,
)); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>

  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'title'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'description'); ?>
    <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model,'description'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->dropDownList($model,'status',$model->statusLabels()); ?>
    <?php echo $form->error($model,'status'); ?>
  </div>

  <h3>Choices</h3>

  <table id="poll-choices">
    <thead>
      <th>Weight</th>
      <th>Label</th>
      <th>Actions</th>
    </thead>
    <tbody>
    <?php
      $newChoiceCount = 0;
      foreach ($choices as $choice) {
        $this->renderPartial('/pollchoice/_formChoice', array(
          'id' => isset($choice->id) ? $choice->id : 'new'. ++$newChoiceCount,
          'choice' => $choice,
        ));
      }
      ++$newChoiceCount; // Increase once more for Ajax additions
    ?>
    <tr id="add-pollchoice-row">
      <td class="weight"></td>
      <td class="label">
        <?php echo CHtml::textField('add_choice', '', array('size'=>60, 'id'=>'add_choice')); ?>
        <div class="errorMessage" style="display:none">You must enter a label.</div>
      </td>
      <td class="actions">
        <a href="#" id="add-pollchoice">Add Choice</a>
      </td>
    </tr>
    </tbody>
  </table>

  <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$callback = Yii::app()->createUrl('/poll/pollchoice/ajaxcreate');
$js = <<<JS
var PollChoice = function(o) {
  this.target = o;
  this.label  = jQuery(".label input", o);
  this.weight = jQuery(".weight select", o);
  this.errorMessage = jQuery(".errorMessage", o);

  var pc = this;

  pc.label.blur(function() {
    pc.validate();
  });
}
PollChoice.prototype.validate = function() {
  var valid = true;

  if (this.label.val() == "") {
    valid = false;
    this.errorMessage.fadeIn();
  }
  else {
    this.errorMessage.fadeOut();
  }

  return valid;
}

var newChoiceCount = {$newChoiceCount};
var addPollChoice = new PollChoice(jQuery("#add-pollchoice-row"));

jQuery("tr", "#poll-choices tbody").each(function() {
  new PollChoice(jQuery(this));
});

jQuery("#add-pollchoice").click(function() {
  if (addPollChoice.validate()) {
    jQuery.ajax({
      url: "{$callback}",
      type: "POST",
      dataType: "json",
      data: {
        id: "new"+ newChoiceCount,
        label: addPollChoice.label.val()
      },
      success: function(data) {
        addPollChoice.target.before(data.html);
        addPollChoice.label.val('');
        new PollChoice(jQuery('#'+ data.id));
      }
    });

    newChoiceCount += 1;
  }

  return false;
});
JS;

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('pollHelp', $js, CClientScript::POS_END);
?>
