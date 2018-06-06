<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model{
	public function handles($info){
		if($info['keywords']){	//处理关键词，
			$info['keywords']=str_replace('，',',',$info['keywords']);
		}
		return $info;
	}
	public function handle($info){	//处理数据
		foreach($info as $k=>$v){
			switch($v['cate_type']){
			case 5:
				$info[$k]['cate_type']='普通分类';
				break;
			default:
				$info[$k]['cate_type']='系统内置';
			}
			switch($v['show_nav']){
			case 1:
				$info[$k]['show_nav']='显示';
				break;
			case 0:
				$info[$k]['show_nav']='不显示';
			}
		}
	return $info;
	}
	public function addhandle($res){	//add数据处理
		static $arr;
		foreach($res as $k=>$v){
				$arr[]=$v;
		}
		return $arr;
	}
}
