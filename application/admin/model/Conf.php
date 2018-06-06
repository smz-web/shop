<?php
namespace app\admin\model;
use think\Model;
class Conf extends Model{
	public function handles($info){
		if($info['values']){	//处理关键词，
			$info['values']=str_replace('，',',',$info['values']);
		}
		return $info;
	}
	public function handle($info){	//处理数据
		foreach($info as $k=>$v){
			switch($v['area']){
			case 1:
				$info[$k]['area']='店铺配置';
				break;
			case 2:
				$info[$k]['area']='商品配置';
			}
		}
	return $info;
	}
	public function handle_array($data){	//处理数组
		foreach($data as $k=>$v){
			if(is_array($v)){
				$data[$k]=implode(',',$v);
			}
		}
		return $data;
	}
}
