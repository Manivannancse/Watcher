<?php
class UsageCaseCommand extends CConsoleCommand{
	public function run($args){
		if (isset($args[0])) {
			switch ($args[0]) {
				case 'help':self::usage();break;
				case 'insert':self::insert();break;
				case 'find':self::find();break;
				case 'findLatestOne':self::findLatestOne();break;
				default:$this->usage();break;
			}
		} else {
			$this->usage();
		}
	}
	
	private function usage(){
		echo "Usage: \n";
		echo "\tinsert\t\tinsert into mongodb\n";
		echo "\tfind\t\tfind the first document in mongodb\n";
		echo "\tfindLatestOne\t\tfind the latest document\n";
	}
	
	/**
	 * 
	 * insert a new document into mongo:can
	 */
	private function insert(){
		$can = new Can();
		$can->tableName 	= 'test';
		$can->maxID			= 0;
		$can->sectionTime 	= 0;
		$can->addition 		= 2;
		$can->total 		= 2;
		$can->recordTime 	= time();
		$can->insert();
		echo "new document inserted into mongodb\n";
	}
	
	/**
	 * find the first document in Can
	 */
	private function find(){
		$can = new Can();
		$docment = $can->find();
		print_r($docment);
	}
	
	/**
	 * find the latest document:order by recordTime
	 */
	private function findLatestOne(){
		$can = new Can();
		$criteria = new EMongoCriteria();
		$criteria->tableName = 'test';
		$criteria->sort('recordTime', EMongoCriteria::SORT_DESC);
		$dList = $can->find($criteria);
		print_r($dList->recordTime);
	}
}