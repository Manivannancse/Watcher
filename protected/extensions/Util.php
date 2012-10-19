<?php
class Util {
	public static function loadconfig($k){
		static $cfg;
		if(!$cfg){
			$cfg = array();
		}
		if(!isset($cfg[$k])){
			if(file_exists(dirname(__FILE__).'/../config/watcher/'.$k.'.cfg.php')){
			   	$cfg[$k] = require(dirname(__FILE__).'/../config/watcher/'.$k.'.cfg.php');
			}
		}
		if(isset($cfg[$k])){
			return $cfg[$k];
		}else{
			return null;
		}
	}

	//格式化打印变量
	public static function dump($val){
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}

        
	static function formatBMK($nums){
		if($nums==0) return 0;
            $num_K     = 0;
        $num_M     = 0;
        $num_B     = 0;
        $end_num   = $nums;
        if($nums > 99999999999){
                $num_B = (int)($nums/1000000000);
                $end_num  = $num_B."B";
            }elseif($nums > 99999999){
                $num_M = (int)($nums/1000000);
                $end_num  = $num_M."M";
            }elseif($nums > 999999){
                 $num_K = (int)($nums/1000);
                 $end_num  = $num_K."K";
            }
            return $end_num;
	}
        
}
?>