<?php
class SiteController extends Controller{
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex(){
		if((isset($_SESSION['watcherID']) && $_SESSION['watcherID'])){
			$this->render('index');
		}else{
			$this->render('login');
		}
	}
	public function actionLogin(){ 
		$watcherID 	= isset($_SESSION['watcherID']) ? $_SESSION['watcherID'] : '';
		$watcher	= new WWatcher($watcherID, null);
		if ($watcher && $watcher->valid()) {
			$this->redirect("index.php?r=watch/testChart");
		}else{
			$this->render('login');
		}
	}
	public function actionCheck(){ 
		$userName = isset($_REQUEST['username']) ? $_REQUEST['username'] : 0;
		$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : 0;
		$flag = WWatcher::checkName($userName,$password);
		if($flag){
			$this->render('index',array());
		}else{
			$this->render('check',array(
				'username' => $userName,
				'password' => $password,
				'flag'     =>$flag,
			));
		}
	}
	public function actionSign(){ 
		$this->render('sign');
	}
	public function actionInsert(){ 
		$userName 	= isset($_REQUEST['username']) ? $_REQUEST['username'] : 0;
		$email 		= isset($_REQUEST['email']) ? $_REQUEST['email'] : 0;
		$password 	= isset($_REQUEST['password']) ? $_REQUEST['password'] : 0;
		$flag 		= WWatcher::insertMongo($userName,$email,$password);
		if($flag){
			$this->render('login',array());
		}else{
			$this->render('insert',array(
				'username' => $userName,
				'password' => $password,
				'flag'     =>$flag,
			));
		}
	}

}

?>