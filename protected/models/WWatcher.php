<?php
/**
 * 
 * 监控功能的主要模块
 * @author Java
 *
 */
class WWatcher{
	private $_id;
	private $name;
	private $email;
	private $pwd;
	private $lastLoginTime;
	private $auth;
	
	/**
	 * 
	 * 构造函数
	 * @param user's pk $_id
	 * @param document from mongo $dbRecord
	 */
	public function __construct($_id,$dbRecord){
		$this->_id = $_id;
		if (!$dbRecord) {
			$dbRecord = Watcher::model()->findByPk($_id);
		}
	}
	
	/**
	 * 
	 * 初始化对象
	 * @param	mongo document	$dbRecord
	 */
	private function __init($dbRecord){
		if ($dbRecord) {
			$this->name 			= $dbRecord->name;
			$this->email			= $dbRecord->email;
			$this->pwd				= $dbRecord->pwd;
			$this->lastLoginTime	= $dbRecord->lastLoginTime;
			$this->auth				= $dbRecord->auth;
		}else{
			$this->_id = null;
		}
	}
	
	/**
	 * 
	 * check object valid or not
	 */
	public function valid(){
		return $this->_id ? true : false;
	}
	
	/**
	 * 比较传入的用户名和密码与数据库里值是否匹配
	 */
	public static function checkName($name,$password){
		$watcher 		= new Watcher();
		$criteria 		= new EMongoCriteria();
		$criteria->name = $name;
		$criteria->pwd 	= $password;
		$criteria->auth = 1;
		$onePerson 		= $watcher->find($criteria);
		if ($onePerson) {
			$_SESSION['watcherID'] = $onePerson->_id;
			return  true;
		}
		return false;
	}
	
	public static function insertMongo($userName,$email,$password){
		//不能为空
		if(!$userName || !$email || !$password){
			return false;
		}
		$watcher 				= new Watcher();
		$watcher->name 			= $userName;
		$watcher->email 		= $email;
		$watcher->pwd 			= $password;
		$watcher->lastLoginTime = time();
		$watcher->auth 			= 1;
		$watcher->insert();
		if ($watcher->_id) {
			return  true;
		}else{
			return false;
		}
	}
	
	/**
	 * 
	 * 获取某张表的最近数据
	 * @param	table's name			$tableName
	 * @param	xxxx-xx-xx xx:xx:xx		$startTime
	 * @param	xxxx-xx-xx xx:xx:xx		$endTime
	 */
	public function getTableInfo($tableName,$startTime,$endTime){
		$res = array();
		if (self::valid()) {
			$res = WCan::getTableInfo($tableName, $startTime, $endTime);
		}
		return $res;
	}
}
?>