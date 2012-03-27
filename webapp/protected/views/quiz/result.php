<?php $this->beginWidget('ext.bootstrap.widgets.BootHero', array(
    'heading'=>'You did it! You Scored ' . $yourScore . '%',
  )); ?>

<br/>

<h3>Your Score <?php echo $yourScore . '%'; ?></h3>
<?php $this->widget('ext.bootstrap.widgets.BootProgress', array(
    'type'=>'success', // '', 'info', 'success' or 'danger'
    'percent'=>$yourScore, // the progress
    'striped'=>false,
    'animated'=>false,
  )); ?>
<h3>Average Score <?php echo $avgScore . '%'; ?></h3>
<?php $this->widget('ext.bootstrap.widgets.BootProgress', array(
    'type'=>'info', // '', 'info', 'success' or 'danger'
    'percent'=>$avgScore, // the progress
    'striped'=>true,
    'animated'=>false,
)); ?>

<br/>

<p><a class="btn btn-primary btn-large" onClick="document.location='/'">Start The Quiz</a></p>

<?php $this->endWidget(); ?>
