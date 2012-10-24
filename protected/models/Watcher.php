<?php
/**
 * 
 * 数据库表记录数的model
 * @author gongaisheng
 *
 */
class Watcher extends EMongoDocument{
	public $name;			//用户名
	public $email;			//电子邮箱
	public $pwd;			//密码
	public $lastLoginTime;	//最近一次登录时间
	public $auth;			//权限

	/**
	 * this is similar to the get tableName() method. this returns tha name of the
	 * document for this class. this should be in all lowercase.
	 */
	public function getCollectionName(){
		return 'watcher';
	}

	/**
	 * If we override this method to return something different than '_id',
	 * internal methods as findByPk etc. will be using returned field name as a primary key
	 * @return string|array field name of primary key, or array for composited key
	 */
	public function primaryKey(){
		return '_id';
	}

	/**
	 * This is defined as normal. Nothing has changed here
	 *
	 * @return array
	 */
	public function rules() {
		return array(
			array('name, email, pwd, lastLoginTime, auth', 'required'),
		);
	}

	/**
	 * This returns attribute labels for each public variable that will be stored
	 * as key in the database. Is defined just as normal with mysql
	 *
	 * @return array
	 */
	public function attributeLabels(){
		return array(
			'name'			=> 'User Name',
			'email'			=> 'User Email',
			'pwd'			=> 'User Password',
			'lastLoginTime'	=> 'Last Login Time',
			'auth'			=> 'Auth',
		);
	}

	/**
	 * Returns the class name just as nornal.
	 *
	 * @static
	 * @param string $className
	 * @return
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

}
