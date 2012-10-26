<?php
class WatchController extends Controller{
	/**
	 * Declares class-based actions.
	 */
	public function actions(){
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * 
	 * 显示某张表的数据
	 */
	public function actionGetTableInfo(){
		$tableName 	= isset($_REQUEST['tableName']) ? $_REQUEST['tableName'] : 'player';
		$startTime 	= isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : '2012-10-25 00:00:00';
		$endTime 	= isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : '2012-10-24 00:00:00';
		
		$watcher = new WWatcher($_SESSION['watcherID'], NULL);
		Util::dump($watcher->getTableInfo($tableName, $startTime, $endTime));
	}

}

?>