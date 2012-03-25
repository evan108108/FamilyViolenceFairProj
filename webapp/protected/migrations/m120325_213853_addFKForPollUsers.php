<?php

class m120325_213853_addFKForPollUsers extends CDbMigration
{
	public function up()
  {
    $this->addForeignKey('vote_user', 'poll_vote', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE'); 
	}

	public function down()
	{
		 $this->dropForeignKey('vote_user', 'poll_vote'); 
	}
}
