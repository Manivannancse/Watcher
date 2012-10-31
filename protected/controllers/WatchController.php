<?php
class WatchController extends Controller{
	public $layout = "application.views.layouts.chart";
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
		$tableName 	= isset($_REQUEST['tableName']) ? $_REQUEST['tableName'] : 'player_epic_fight';
		$startTime 	= isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : '2012-10-25 20:00:00';
		$endTime 	= isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : '2012-10-26 00:00:00';
		
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		$dataList 	= $watcher->getTabelChartData($tableName, $startTime, $endTime);
		$pc 		= new C_PhpChartX(array($dataList['addition']),'basic_chart');
		$pc->set_animate(true);
		$pc->set_title(array('text' => $tableName));
		$pc->add_plugins(array('cursor'));
		$pc->set_cursor(array('show'=>true,'zoom'=>true));
		//$pc->set_series_default(array('renderer'=>'plugin::BarRenderer'));
		//$pc->add_plugins(array('highlighter', 'cursor'));
		$this->render('testChart',array(
			'pc' 		=> $pc,
			'watcher' 	=> $watcher,
		));
	}
	
	/*
	 * 
	$pc = new C_PhpChartX(array($line1),'plot1');
    $pc->add_plugins(array('canvasTextRenderer','canvasAxisTickRenderer','dateAxisRenderer'),true);
    $pc->set_title(array('text'=>'Rotated Axis Text'));
    $pc->set_axes(array(
            'xaxis'=>array(
                'renderer'=>'plugin::DateAxisRenderer', 
                'min'=>'August 30, 2008', 
                'tickInterval'=>'1 month',
                'rendererOptions'=>array('tickRenderer'=>'plugin::CanvasAxisTickRenderer'),
                'tickOptions'=>array(
					'formatString'=>'%b %#d, %Y', 
					'fontSize'=>'10pt', 
					'fontFamily'=>'Tahoma', 
					'angle'=>-40, 
					'fontWeight'=>'normal', 
					'fontStretch'=>1)
            )
        
    ));
    $pc->add_series(array('lineWidth'=>4,'markerOptions'=>array('style'=>'square')));
	 */
	
	/**
	 * 
	 * 显示某张表的增长数据
	 */
	public function actionTableGrow(){
		$tableName 	= isset($_REQUEST['tableName']) ? $_REQUEST['tableName'] : 'player_epic_fight';
		$startTime 	= isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : date('y-m-d H:i:s',time() - 3600);
		$endTime 	= isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : date('y-m-d H:i:s',time());
		
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		$dataList 	= $watcher->getTabelChartData($tableName, $startTime, $endTime);
		$pc 		= new C_PhpChartX(array($dataList),'basic_chart');
		if($dataList){
			$pc->add_plugins(array('canvasTextRenderer','canvasAxisTickRenderer','dateAxisRenderer'),true);
			$pc->set_axes(array(
				'xaxis'=>array(
		                'renderer'=>'plugin::CategoryAxisRenderer', 
		                'min'=>$dataList[0][0], 
		                'tickInterval'=>30,
		                'rendererOptions'=>array('tickRenderer'=>'plugin::CanvasAxisTickRenderer'),
		                'tickOptions'=>array(
							'formatString'=>'%b %#d, %Y, %H, %m', 
							'fontSize'=>'6pt', 
							'fontFamily'=>'consolas', 
							'angle'=>-30, 
							'color'=>'green',
							'fontWeight'=>'normal', 
							'fontStretch'=>1)
		            )
		        
		    ));
		    $pc->add_series(array('lineWidth'=>4,'markerOptions'=>array('style'=>'square')));
			$pc->set_animate(true);
			$pc->set_title(array('text' => $tableName));
			$pc->add_plugins(array('cursor'));
			$pc->set_cursor(array('show'=>true,'zoom'=>true));
		}
		$this->render('tableGrow',array(
			'dataVal'	=> $dataList,
			'pc' 		=> $pc,
			'watcher' 	=> $watcher,
			'tableName'	=> $tableName,
			'startTime'	=> $startTime,
			'endTime'	=> $endTime,
		));
	}
	
	public function actionTestChart(){
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		if ($watcher && $watcher->valid()) {
			$pc 		= new C_PhpChartX(array(array(11, 9, 5, 12, 14),array(1,2,3,4,5)),'basic_chart');
			$pc->set_animate(true);
			$pc->set_title(array('text' => 'javaXu'));
			$pc->set_series_default(array('renderer'=>'plugin::BarRenderer'));
			$pc->add_plugins(array('highlighter', 'cursor'));
			$this->render('testChart',array(
				'pc' 		=> $pc,
				'watcher' 	=> $watcher,
			));
		}else{
			$this->redirect('index.php?r=site/login');
		}
	}
	
	public function actionTestChart2(){
		$this->render('testChart2');
	}

}

?>