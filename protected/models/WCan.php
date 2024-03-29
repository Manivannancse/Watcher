<?php
class WCan{
	private $_id;
	private $tableName;
	private $maxID;
	private $sectionTime;
	private $recordTime;
	private $addition;
	private $total;
	
	/**
	 * 
	 * 构造函数
	 */
	public function __construct($_id,$dbRecord){
		if (!$dbRecord) {
			$dbRecord = self::getDocumentByPK($_id);
		}elseif ($dbRecord->_id != $_id){
			$dbRecord = null;
		}
		self::__init($dbRecord);
	}
	
	/**
	 * 
	 * 初始化文档对象
	 * @param 数据库文档 $dbRecord
	 */
	private function __init($dbRecord){
		if ($dbRecord) {
			$this->_id 			= $dbRecord->_id;
			$this->maxID 		= $dbRecord->maxID;
			$this->tableName	= $dbRecord->tableName;
			$this->sectionTime	= $dbRecord->sectionTime;
			$this->recordTime	= $dbRecord->recordTime;
			$this->addition		= $dbRecord->addition;
			$this->total		= $dbRecord->total;
		}else{
			$this->_id = null;
		}
	}
	
	/**
	 * 
	 * 检查对象是否有效
	 */
	public function valid(){
		return $this->_id ? true : false;
	}
	
	/**
	 * 
	 * 打印对象属性
	 */
	public function showMyself(){
		if (self::valid()) {
			echo "table {$this->tableName} has total records:{$this->total} with addition:{$this->addition} at time:{$this->recordTime}\n";
		}else{
			echo "this object is null\n";
		}
	}
	
	/**
	 * 获取某个表名的上一次插入的记录
	 */
	public static function getLatestRecordByTableName($tableName){
		$watchList = Util::loadconfig('watchList');
		if ($tableName && array_key_exists($tableName, $watchList)) {
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
	
	/**
	 * 
	 * 通过主键获取文档
	 * @param 主键 $pk
	 */
	public static function getDocumentByPK($pk){
		if ($pk) {
			return Can::model()->findByPk($pk);
		}
		return null;
	}
	
	/**
	 * 
	 * 获取某张表上一次的最大ID
	 * @param 表名 $tableName
	 */
	public static function getLastMaxIDByTableName($tableName){
		$lastDoc = self::getLatestRecordByTableName($tableName);
		if ($lastDoc) {
			return $lastDoc->maxID;
		}	
		return 0;
	}
	
	/**
	 * 
	 * 获取某张表上一次的最大时间
	 * @param 表名 $tableName
	 */
	public static function getLastMaxTimeByTableName($tableName){
		$lastDoc = self::getLatestRecordByTableName($tableName);
		if ($lastDoc) {
			return $lastDoc->sectionTime;
		}	
		return 0;
	}
	
	/**
	 * 
	 * 获取某张表上一次的最大时间
	 * @param 表名 $tableName
	 */
	public static function getLastCountByTableName($tableName){
		$lastDoc = self::getLatestRecordByTableName($tableName);
		if ($lastDoc) {
			return $lastDoc->total;
		}	
		return 0;
	}
	
	/**
	 * 
	 * 获取某张表的最近数据
	 * @param	table's name	$tableName
	 * @param	int time		$startTime
	 * @param	int time 		$endTime
	 */
	public static function getTableInfo($tableName,$startTime,$endTime){
		$result = array();
		$watchList = Util::loadconfig('watchList');
		if ($tableName && array_key_exists($tableName, $watchList)) {
			$can 		= new Can();
			$criteria 	= new EMongoCriteria();
			$criteria->tableName = $tableName;
			$criteria->recordTime('>=',$startTime);
			$criteria->recordTime('<=',$endTime);
			$criteria->sort('recordTime', EMongoCriteria::SORT_ASC);
			$result = $can->findAll($criteria);
		}
		return $result;
	}
	
	/**
	 * 获取增量数值的index
	 */
	public function getAdditionIndex($startTime,$step){
		if (self::valid()) {
			$timeSection = $this->recordTime - $startTime;
			$modVal = $timeSection % ($step * 60);
			$count	= ($timeSection - $modVal) / ($step * 60);
			return date('H:i',$startTime + $count * 60 * $step);
		}	
		return 0;	
	}
	
	/**
	 * 获取增量数值的index:时间段环比方式
	 */
	public function getAdditionIndexSection($startTime,$step){
		if (self::valid()) {
			$timeSection 	= $this->recordTime - $startTime;
			$modVal 		= $timeSection % ($step * 60);
			$count			= ($timeSection - $modVal) / ($step * 60);
			$dayIndex		= self::getDayIndex($startTime);
			return $dayIndex . date('H:i',$startTime + $count * 60 * $step);
		}	
		return 0;	
	}
	
	/**
	 * 
	 * 获取时间段环比方式的x轴标记的头部
	 * @param 开始时间 $startTime
	 */
	public function getDayIndex($startTime){
		if (self::valid()) {
			$startZero 		= strtotime(date('Y-m-d 00:00:00', $startTime));
			$timeSection 	= abs($startTime - $this->recordTime);
			$modVal			= $timeSection % 86400;
			$pVal 			= $timeSection - $modVal;
			$count 			= floor($pVal ? ($pVal / 86400 + 1) : 1);
			//echo "{$timeSection} vs {$count} - {$modVal}<br>";
			return "{$count}X";
		}
		return '1X';
	}
	
	/**
	 * 获取时间段的index
	 */
	public function getStepIndex($startTime,$step){
		if (self::valid()) {
			$timeSection = $this->recordTime - $startTime;
			$modVal = $timeSection % ($step * 60);
			$count	= ($timeSection - $modVal) / ($step * 60);
			return $count + 1;
		}
		return 0;
	}
	
	/**
	 * 获取增量
	 */
	public function getAddition(){
		return self::valid() ? $this->addition : 0;		
	}
	
	
	
	

}


?>