<script language="javascript">
  function doVote(poll, pollChioce)
  {
    //alert(pollChioce);
    $.get('/quiz/answer/quizId/' + poll + '/quizAnswer/' + pollChioce, function(data) {
      data = eval('(' + data + ')');
      //alert(data.answerExplination);
      
      if(data.userResponse > 0)
        $('#modalHeader').get(0).innerHTML = '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert"></a><strong>Correct! Well done!</strong></div>';
      else
        $('#modalHeader').get(0).innerHTML = '<div class="alert alert-block alert-error fade in"><a class="close" data-dismiss="alert"></a><strong>Incorrect! The correct answer was "' + data.correctAnswer.label + '"</strong>.</div>';

      $('#modalBody').get(0).innerHTML = "<h3>" + data.answerExplination + "</h3>";

      $(modalStats).html('');

      for(i in data.choice)
      {
        $(modalStats).append('<h4>' + data.choice[i].label +  " %" + data.choice[i].precentage + '</h4>');
        if(data.choice[i].right_answer > 0)
        {
          $(modalStats).append('<div class="progress progress-success progress"><div class="bar" style="width:' + data.choice[i].precentage + '%;"></div></div>');
        }
        else
        {
          $(modalStats).append('<div class="progress progress-danger progress"><div class="bar" style="width:' + data.choice[i].precentage + '%;"></div></div>');
        }
      }

      $('#modalOpener').click();
    });
  }
</script>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
  )); ?>
<h1><?php echo $poll->title; ?></h1>
<br>
<?php for($i=0; $i<count($poll->choices); $i++): ?>
  <?php $this->widget('ext.bootstrap.widgets.BootButton', array(
        'label'=>$poll->choices[$i]->label,
        'type'=>$this->bootStyles[$i], // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // '', 'large', 'small' or 'mini'
        'htmlOptions'=>array('onclick'=>"doVote(" . $poll->id . ", " . $poll->choices[$i]->id . ")", 'data-toggle'=>"modal"),
  )); ?>
<?php endfor; ?>

<?php $this->endWidget(); ?>

<?php $this->beginWidget('ext.bootstrap.widgets.BootModal', array(
    'id'=>'modal',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('modal show.'); }",
        'shown'=>"js:function() { console.log('modal shown.'); }",
        'hide'=>"js:function() { console.log('modal hide.'); }",
        'hidden'=>"js:function() { console.log('modal hidden.'); document.location='/quiz/index/quizId/" . $this->nextQuiz . "' }",
    ),
)); ?>
<div class="modal-header">
    <h3 id="modalHeader"></h3>
</div>
<div class="modal-body">
    <p id="modalBody">One fine body…</p>
    <p id="modalStats"></p>
</div>
<div class="modal-footer">
    <?php echo CHtml::link('Next Question', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
    <?php //echo CHtml::link('Close', '#', array('class'=>'btn', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget(); ?>


<?php echo CHtml::link('Click me','#modal', array('id'=>'modalOpener', 'class'=>'btn btn-primary', 'data-toggle'=>'modal', 'style'=>'visibility:hidden')); ?>
