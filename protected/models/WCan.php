<?php
class WCan{
	
	/**
	 * 获取某个表名的上一次插入的记录
	 */
	public static function getLatestRecordByTableName($tableName){
		$watchList = Util::loadconfig('watchList');
		//if ($tableName && array_key_exists($tableName, $watchList)) {
		if ($tableName) {
			$can 		= new Can();
			$criteria 	= new EMongoCriteria();
			$criteria->tableName = $tableName;
			$criteria->sort('recordTime', EMongoCriteria::SORT_DESC);
			$criteria->limit(1);
			$dList = $can->findAll($criteria);			
			if ($dList) {
				return $dList[0];
			}
		}
		return null;
	}
}