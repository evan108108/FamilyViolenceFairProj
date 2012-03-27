<?php

class QuizController extends Controller
{

  public $bootStyles = array('success', 'danger', 'warning', 'primary', 'info', 'inverse');
  
  public $quizes = array();

  public $nextQuiz = false;

  public function beforeAction()
  {
    $polls = Poll::model()->findAll();
    foreach($polls as $poll)
      $this->quizes[] = $poll->id;

    if(!isset($_GET['quizId']))
      $_GET['quizId'] = $this->quizes[0];

    
    $currentKey = array_search($_GET['quizId'], $this->quizes);
    if($currentKey != (count($this->quizes)-1))
      $this->nextQuiz = $this->quizes[($currentKey + 1)];
    else
      $this->nextQuiz = 'end';

    return parent::beforeAction($this->action->id);
  }

  public function actionStartQuiz()
  {
    $newUser = $this->createQuizUser();
    $this->redirect(array('index','quizId'=>1));
  }
  
	public function actionIndex($quizId=false)
  {
    if($quizId == 'end')
      $this->redirect('/quiz/result');
    else
    {
      if(!$quizId)
        $quizId = $this->quizes[0];

      $poll = Poll::model()->findByPk($quizId);
      $this->render('index', array('poll'=>$poll));
    }
  }

  public function actionResult()
  {
    $votes = PollVote::model()->with('choice')->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
    $totalVotes = count($votes);
    $votesCorrect = 0;
    foreach($votes as $vote)
    {
      if($vote->choice->right_answer > 0)
        $votesCorrect++;
    }
    $score = ( $votesCorrect > 0 ) ? 100 * round($votesCorrect / $totalVotes, 2) : 0;

    $allVotes = PollVote::model()->with('choice')->findAll();
    $allTotalVotes = count($allVotes);
    $allCorrectVotes = 0;
    foreach($allVotes as $allVote)
    {
      if($allVote->choice->right_answer > 0)
        $allCorrectVotes++;
    }

    $avgScore = ($allCorrectVotes > 0) ? 100 * round($allCorrectVotes / $allTotalVotes, 2) : 0;


    $this->render('result', array('yourScore'=>$score, 'avgScore'=>$avgScore));
  }

  public function actionAnswer($quizId, $quizAnswer)
  {
    $pollChoice = PollChoice::model()->findByPk($quizAnswer);
    $pollChoice->votes += 1;
    if(!$pollChoice->save())
      throw new CHttpException(500, 'Could not save the vote total');

    $vote = PollVote::model()->findByAttributes(array('choice_id'=>$quizAnswer, 'poll_id'=>$quizId, 'user_id'=>Yii::app()->user->id));
    if(is_null($vote))
      $vote = new PollVote;
    $vote->choice_id = $quizAnswer;
    $vote->poll_id = $quizId;
    $vote->user_id = Yii::app()->user->id;
    $vote->ip_address = CHttpRequest::getUserHostAddress();
    if(!$vote->save())
      throw new CHttpException(500, 'Could not save the vote for this user');

    $response = array();
    
    $poll = Poll::model()->with('choices')->findByPk($quizId);
    if(is_null($poll))
      throw new CHttpException(500, 'Could not find poll with id = ' . $quizId);

    foreach($poll->choices as $choice)
    {
      $response['choice'][$choice->id]['label'] = $choice->label;
      $response['choice'][$choice->id]['right_answer'] = $choice->right_answer;
      $response['choice'][$choice->id]['precentage'] = $poll->totalVotes > 0 ? 100 * round($choice->votes / $poll->totalVotes, 2) : 0;
      
      if($choice->right_answer > 0)
      {
        $response['correctAnswer']['id'] = $choice->id;
        $response['correctAnswer']['label'] = $choice->label;
      }
    }

    $response['userResponse'] = $pollChoice->right_answer;
    $response['answerExplination'] = $poll->description;
 
    echo CJSON::encode($response);
    Yii::app()->end();
  }

  private function createQuizUser()
  {
    $model=new User;
    $profile=new Profile;
    
    $userCnt = User::model()->count();
    
    $model->username = "quiz_user_" . $userCnt;
    $model->password = $model->username;
    //$model->verifyPassword = $model->password;
    $model->activkey=UserModule::encrypting(microtime().$model->password);
    $model->password=UserModule::encrypting($model->password);
		//$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
    $model->createtime=time();
    $model->lastvisit=time();
    $model->email = $model->username . "@quize-user.com";
    $model->superuser = 0;
    $model->status = User::STATUS_ACTIVE;
    $profile->firstname = $model->username;
    $profile->lastname = $model->username;
    $profile->birthday = '2012-03-27';
    if($model->validate() && $profile->validate()) {
      if($model->save()) {
        $profile->user_id=$model->id;
        $profile->save();
      }
    }
    else 
       throw new CHttpException(500, "Could not create quiz user");

    $login = new LoginForm;
    $login->username = $model->username;
    $login->password = $model->username;
    if(!$login->login())
      throw new CHttpException(500, "Could not login new quiz user");

    return $model->id;
  }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
