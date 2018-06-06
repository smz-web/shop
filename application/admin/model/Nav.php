<?php
namespace app\admin\model;
use think\Model;
class Nav extends Model{
	public function list_handle($info){
		foreach($info as $k=>$v){
			switch($v['nav_pos']){
				case 1:
				$info[$k]['nav_pos']='top';
				break;
				case 2:
				$info[$k]['nav_pos']='head';
				break;
				case 3:
				$info[$k]['nav_pos']='foot';
				break;
			}
		}
		return $info;
	}
    public function handle($info){
    	if($info['nav_link'] && stripos($info['nav_link'],'http://')===false){	//处理网址未带 http://
    		$info['nav_link']='http://'.$info['nav_link'];
    	}
    	return $info;
    }
}
