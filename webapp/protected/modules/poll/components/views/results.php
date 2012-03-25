<div class="poll-results">
<?php
  foreach ($model->choices as $choice) {
    $this->render('poll.views.pollchoice._resultsChoice', array(
      'choice' => $choice,
      'percent' => $model->totalVotes > 0 ? 100 * round($choice->votes / $model->totalVotes, 3) : 0,
      'voteCount' => $choice->votes,
    ));
  }
?>
</div>
