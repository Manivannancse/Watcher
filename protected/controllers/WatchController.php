<?php
class WatchController extends Controller{
	public $layout = "application.views.layouts.char";
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
	
	public function actionTestChart(){
		$pc = new C_PhpChartX(array(array(11, 9, 5, 12, 14),array(1,2,3,4,5)),'basic_chart');
		$pc->set_animate(true);
		$pc->set_title(array('text' => 'javaXu'));
		$pc->set_series_default(array('renderer'=>'plugin::BarRenderer'));
		$pc->add_plugins(array('highlighter', 'cursor'));
		$this->render('testChart',array(
			'pc' => $pc
		));
	}
	
	public function actionTestChart2(){
		$this->render('testChart2');
	}

}

?>