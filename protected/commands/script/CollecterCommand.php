<?php
class CollecterCommand extends CConsoleCommand{
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
		$tableAttr = Util::loadconfig('watchList');
		$dba = Yii::app()->db;
		$consts = 100;
		foreach($tableAttr as $tableName => $r){
			try{
				if($r['byID'] == 1 && $r['byTime'] == 0){
					$lastMaxID = WCan::getLastMaxIDByTableName($tableName);
					$cmd = $dba->createCommand("
						select max($r[colName]) as maxID,count(*) as total
						from $tableName
					");
					$res = $cmd->queryRow(true,array());
					$newMaxID = (int)$res['maxID'];
					$newTotal = (int)$res['total'];
					if($newTotal >= $consts){
						$newRecord = new NewRecord();
						$newRecord->tableName 	= $tableName;
						$newRecord->maxID			= $newMaxID;
						$newRecord->sectionTime 	= 0;
						$newRecord->addition 		= $addition;
						$newRecord->total 		= $newTotal;
						$newRecord->recordTime 	= time();
						$newRecord->upset();
						echo "new millionRecord inserted into mongodb\n";
					}
					$cmd = $dba->createCommand("
						select count(*) as addition
						from $tableName
						where $r[colName]>:lastMaxID
					");
					$res = $cmd->queryRow(true,array(':lastMaxID' => $lastMaxID));
					$addition = (int)$res['addition'];
					$can = new Can();
					$can->tableName 	= $tableName;
					$can->maxID			= $newMaxID;
					$can->sectionTime 	= 0;
					$can->addition 		= $addition;
					$can->total 		= $newTotal;
					$can->recordTime 	= time();
					$can->insert();
				}else if($r['byID'] == 0 && $r['byTime'] == 1){
					$lastTime = WCan::getLastMaxTimeByTableName($tableName);
					$cmd = $dba->createCommand("
						select max($r[colName]) as lastTime,count(*) as total
						from $tableName
					");
					$res = $cmd->queryRow(true,array());
					$newLastTime = (int)$res['lastTime'];
					$newTotal = (int)$res['total'];
					if($newTotal >= $consts){
						$newRecord = new NewRecord();
						$newRecord->tableName 	= $tableName;
						$newRecord->maxID			= $newMaxID;
						$newRecord->sectionTime 	= 0;
						$newRecord->addition 		= $addition;
						$newRecord->total 		= $newTotal;
						$newRecord->recordTime 	= time();
						$newRecord->upset();
						echo "new millionRecord inserted into mongodb\n";
					}
					$cmd = $dba->createCommand("
						select count(*) as addition
						from $tableName
						where $r[colName]>:lastTime
					");
					$res = $cmd->queryRow(true,array(':lastTime' => $lastTime));
					$addition = (int)$res['addition'];
					$can = new Can();
					$can->tableName 	= $tableName;
					$can->maxID			= 0;
					$can->sectionTime 	= $newLastTime;
					$can->addition 		= $addition;
					$can->total 		= $newTotal;
					$can->recordTime 	= time();
					$can->insert();
				}else{
					$lastCount = WCan::getLastCountByTableName($tableName);
					$cmd = $dba->createCommand("
						select count(*) as total
						from $tableName
					");
					$res = $cmd->queryRow(true,array());
					$newTotal = $res['total'];
					if($newTotal >= $consts){
						$newRecord = new NewRecord();
						$newRecord->tableName 	= $tableName;
						$newRecord->maxID			= $newMaxID;
						$newRecord->sectionTime 	= 0;
						$newRecord->addition 		= $addition;
						$newRecord->total 		= $newTotal;
						$newRecord->recordTime 	= time();
						$newRecord->upset();
						echo "new millionRecord inserted into mongodb\n";
					}
					$addition = $newTotal - $lastCount;
					$can = new Can();
					$can->tableName 	= $tableName;
					$can->maxID			= 0;
					$can->sectionTime 	= 0;
					$can->addition 		= $addition;
					$can->total 		= (int)$newTotal;
					$can->recordTime 	= time();
					$can->insert();
				}
			}catch (Exception $e) {
				continue;
			}
		}
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