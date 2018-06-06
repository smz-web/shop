<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Category extends Model{
	public function category_info(){	//获取商品分类
		$res=\think\Db::name('Category')->where(['show_nav'=>1])->select();
		$res=$this->category_info2($res);
		return $res;
	}
	protected function category_info2($info,$pid=0,$level=0){
		static $arr=array();
		foreach($info as $k=>$v){
			if($v['pid']==$pid){
				$v['level']=$level+1;
				$arr[]=$v;
				$this->category_info2($info,$v['id'],$v['level']);
			}
		}
		return $arr;
	}
	public function get_category_one($id){	//获取当前展开的子栏目
		$res=Db::name('category')->where(['pid'=>$id])->select();
		foreach($res as $k=>$v){
			$res[$k]['son_one']=Db::name('category')->where(['pid'=>$v['id']])->select();
		}
		return $res;
	}
}
