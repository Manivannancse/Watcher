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
		$lastMaxID = WCan::getLastMaxIDByTableName('player');
		
		$dba = Yii::app()->db;
		$cmd = $dba->createCommand("
			select max(id) as maxID,count(*) as total
			from player
		");
		$res = $cmd->queryRow(true,array());
		$newMaxID = $res['maxID'];
		$newTotal = $res['total'];
		
		$cmd = $dba->createCommand("
			select count(*) as addition
			from player
			where id>:lastMaxID
		");
		$res = $cmd->queryRow(true,array(':lastMaxID' => $lastMaxID));
		$addition = $res['addition'];
		
		$can = new Can();
		$can->tableName 	= 'player';
		$can->maxID			= $newMaxID;
		$can->sectionTime 	= 0;
		$can->addition 		= $addition;
		$can->total 		= $newTotal;
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
		$doc = WCan::getLatestRecordByTableName('account');
		$wCan = new WCan($doc->_id, $doc);
		$wCan->showMyself();
	}
}