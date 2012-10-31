<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController{
	/**
     * @var string the default layout for the controller view. Defaults to 'application.views.layouts.column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='application.views.layouts.main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    protected function beforeAction($action){
		$session = new CHttpSession;
		$session->open();
		
		//$controllerID = $action->getController()->getId();
		$actionID = $action->getController()->getAction()->getId();
		if((isset($_SESSION['watcherID']) && $_SESSION['watcherID']) || $actionID == 'sign' || $actionID == 'check' || $actionID == 'insert'){
			return true;
		}else{
			$_SESSION['watcherID'] = 0;
			$_SESSION['watcherName'] = 0;
			//$action->getController()->render('/site/login');
			$action->getController()->redirect("index.php?r=site/login");
			return;
		}
    }
	
}