<?php
/**
 * 
 * 监控功能的主要模块
 * @author Java
 *
 */
class WWatcher{
	private $name;
	private $email;
	private $pwd;
	private $lastLoginTime;
	private $auth;
	/**
	 * 比较传入的用户名和密码与数据库里值是否匹配
	 */
	public static function checkName($name,$password){
		$watcher = new Watcher();
		$criteria 	= new EMongoCriteria();
		$criteria->name = $name;
		$criteria->pwd = $password;
		$criteria->auth = 1;
		$onePerson = $watcher->find($criteria);
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
		$watcher = new Watcher();
		$watcher->name = $userName;
		$watcher->email = $email;
		$watcher->pwd = $password;
		$watcher->lastLoginTime = time();
		$watcher->auth = 1;
		$watcher->insert();
		if ($watcher->_id) {
			return  true;
		}else{
			return false;
		}
	}
}
?>