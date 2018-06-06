<?php
namespace app\admin\model;
use think\Model;
class Attr extends Model{
    public function handle($info){
    	if($info['values']){	//处理关键词，
			$info['values']=str_replace('，',',',$info['values']);
		}
    	return $info;
    }
    public function handles($info){
    	foreach($info as $k=>$v){
    		switch($v['attr_type']){
    		case 1:
    		$info[$k]['attr_type']='唯一';
    		break;
    		case 2:
    		$info[$k]['attr_type']='单选';
    		}
    	}
    	return $info;
    }
}
