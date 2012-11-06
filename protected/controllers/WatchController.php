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
	
	/**
	 * 
	 * 显示某张表的增长数据:按天环比
	 */
	public function actionTableGrow(){
		$tableName 	= isset($_REQUEST['tableName']) ? $_REQUEST['tableName'] : 'player_epic_fight';
		$startTime 	= isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : date('Y-m-d 00:00:00',time());
		$endTime 	= isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : date('Y-m-d 23:59:59',time());
		$step		= isset($_REQUEST['step']) ? $_REQUEST['step'] : 15;
		
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		$dataList 	= $watcher->getTabelChartData($tableName, strtotime($startTime), strtotime($endTime),$step);
		$yestList	= $watcher->getTabelChartData($tableName, strtotime($startTime) - 86400, strtotime($endTime) - 86400,$step);
		$zestList	= $watcher->getTabelChartData($tableName, strtotime($startTime) - 86400*2, strtotime($endTime) - 86400*2,$step);
		//Util::dump($dataList);Util::dump($yestList);exit;
		$pc 		= new C_PhpChartX(array($dataList,$yestList,$zestList),'chart1');
		if($dataList){
			$pc->add_plugins(array('canvasTextRenderer','canvasAxisTickRenderer'),true);
			$pc->set_axes(array(
				'xaxis'=>array(
		                'renderer' 			=> 'plugin::CategoryAxisRenderer', 
		                'min'				=> $dataList[0][0], 
		                'tickInterval'		=> 30,
		                'rendererOptions'	=> array('tickRenderer'=>'plugin::CanvasAxisTickRenderer'),
		                'tickOptions'		=> array(
							'fontSize'			=> '6pt', 
							'fontFamily'		=> 'consolas', 
							'angle'				=> -30, 
							'color'				=> 'green',
							'fontWeight'		=> 'normal', 
							'fontStretch'		=> 1
						)
				)
		    ));
			$pc->set_animate(true);
			$pc->set_legend(array(
				'renderer' 			=> 'plugin::EnhancedLegendRenderer',
				'show' 				=> true,
				'location' 			=> 'e',
				'placement'			=> 'outside',
				'yoffset' 			=> 30,
				'rendererOptions' 	=> array('numberRows'=>3),
				'labels'			=> array(
					date('Y-m-d',strtotime($startTime)), 
					date('Y-m-d',strtotime($startTime) - 86400), 
					date('Y-m-d',strtotime($startTime) - 86400 * 2)
				)   
			));
			$pc->set_title(array('text' => $tableName));
			$pc->add_plugins(array('cursor'));
			$pc->set_cursor(array('show'=>true,'zoom'=>true));
			
			$pc->jqplot_show_plugins(true);
		    $pc->add_series(array('showLabel'=>true));
		    $pc->add_series(array('showLabel'=>true));
			
		}
		$this->render('tableGrow',array(
			'dataVal'	=> $dataList,
			'pc' 		=> $pc,
			'watcher' 	=> $watcher,
			'tableName'	=> $tableName,
			'startTime'	=> $startTime,
			'endTime'	=> $endTime,
			'step'		=> $step,
		));
	}
	
	/**
	 * 
	 * 显示某张表的增长数据:按时间段环比
	 */
	public function actionTableGrowSection(){
		$tableName 	= isset($_REQUEST['tableName']) ? $_REQUEST['tableName'] : 'player_epic_fight';
		$startTime 	= isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : date('Y-m-d 00:00:00',time() - 3600);
		$endTime 	= isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : date('Y-m-d 23:59:59',time());
		$step		= isset($_REQUEST['step']) ? $_REQUEST['step'] : 60;
		
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		$dataList 	= $watcher->getTabelChartData($tableName, strtotime($startTime), strtotime($endTime),$step);
		$yestList	= $watcher->getTabelChartData($tableName, 2 * strtotime($startTime) - strtotime($endTime), strtotime($startTime),$step);
		$zestList	= $watcher->getTabelChartData($tableName, strtotime($startTime) - 86400*2, strtotime($endTime) - 86400*2,$step);
		//Util::dump($dataList);Util::dump($yestList);exit;
		$pc 		= new C_PhpChartX(array($dataList,$yestList,$zestList),'chart1');
		if($dataList){
			$pc->add_plugins(array('canvasTextRenderer','canvasAxisTickRenderer'),true);
			$pc->set_axes(array(
				'xaxis'=>array(
		                'renderer' 			=> 'plugin::CategoryAxisRenderer', 
		                'min'				=> $dataList[0][0], 
		                'tickInterval'		=> 30,
		                'rendererOptions'	=> array('tickRenderer'=>'plugin::CanvasAxisTickRenderer'),
		                'tickOptions'		=> array(
							'fontSize'			=> '6pt', 
							'fontFamily'		=> 'consolas', 
							'angle'				=> -30, 
							'color'				=> 'green',
							'fontWeight'		=> 'normal', 
							'fontStretch'		=> 1
						)
				)
		    ));
			$pc->set_animate(true);
			$pc->set_legend(array(
				'renderer' 			=> 'plugin::EnhancedLegendRenderer',
				'show' 				=> true,
				'location' 			=> 'e',
				'placement'			=> 'outside',
				'yoffset' 			=> 30,
				'rendererOptions' 	=> array('numberRows'=>3),
				'labels'			=> array(
					date('Y-m-d',strtotime($startTime)), 
					date('Y-m-d',strtotime($startTime) - 86400), 
					date('Y-m-d',strtotime($startTime) - 86400 * 2)
				)   
			));
			$pc->set_title(array('text' => $tableName));
			$pc->add_plugins(array('cursor'));
			$pc->set_cursor(array('show'=>true,'zoom'=>true));
			
			$pc->jqplot_show_plugins(true);
		    $pc->add_series(array('showLabel'=>true));
		    $pc->add_series(array('showLabel'=>true));
			
		}
		$this->render('tableGrow',array(
			'dataVal'	=> $dataList,
			'pc' 		=> $pc,
			'watcher' 	=> $watcher,
			'tableName'	=> $tableName,
			'startTime'	=> $startTime,
			'endTime'	=> $endTime,
			'step'		=> $step,
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
	
	/**
	 * 显示记录总数大于100w的表
	 */
	public function actiondangerTable(){
		$watcher 	= new WWatcher($_SESSION['watcherID'], NULL);
		if ($watcher && $watcher->valid()) {
			
			//获取total大于100w的表
			$millionTable = $watcher -> getMillionTable();
			$this->render('dangerTable',array(
				'millionTable'  => $millionTable,
			));
		}
	}

	
	
}

?>