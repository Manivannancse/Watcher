<?php
/**
 * 
 * 数据库表记录数的model
 * @author Java
 *
 */
class NewRecord extends EMongoDocument{
	public $tableName;			//表名
	public $maxID;				//最大的ID
	public $sectionTime;		//用来取分段数据量的时间点
	public $recordTime;			//数据生成时间
	public $addition;			//数据增量
	public $total;				//数据总量

	/**
	 * this is similar to the get tableName() method. this returns tha name of the
	 * document for this class. this should be in all lowercase.
	 */
	public function getCollectionName(){
		return 'newRecord';
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
			array('tableName, maxID, sectionTime, recordTime, addition, total', 'required'),
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
			'tableName'			=> 'Table Name',
			'maxID'				=> 'Max ID',
			'sectionTime'		=> 'Section Time',
			'recordTime'		=> 'Record Time',
			'addition'			=> 'Addition Quantity',
			'total'				=> 'Total Quantity',
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
