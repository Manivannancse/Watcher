<?php
class CollecterCommand extends CConsoleCommand{
	
	public function run($args){
		/**
		 * 1 fetch data from mysql 
		 * 2 store data into mongodb
		 */

		/**
		 * case for write data into mongodb collection - Can
		 * 
		 * 
		 
		$can = new Can();
		$can->tableName = 'test';
		$can->maxID	= 0;
		$can->sectionTime = 0;
		$can->addition = 1;
		$can->total = 1;
		$can->recordTime = time();
		$can->insert();
		*/
		$can = new Can();
		Util::dump($can->findByAttributes(array('tableName' => 'account')));
	}	
}

?>