<?php $this->beginWidget('ext.bootstrap.widgets.BootHero', array(
    'heading'=>'Welcome to the Family Violence Fair!',
)); ?>
<?php $this->pageTitle=Yii::app()->name; ?>

<h2>The <i><?php echo CHtml::encode(Yii::app()->name); ?> Booth</i></h2>

<p>Take this quiz to test your knowledge and earn a raffle ticket!</p>

<p><a class="btn btn-primary btn-large" onClick="document.location='/quiz/startQuiz'">Start The Quiz</a></p>
<?php $this->endWidget(); ?>
