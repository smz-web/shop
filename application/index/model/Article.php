<?php
namespace app\index\model;
use think\Model;
class Article extends Model{
	public function cate_info_handle($info,$pid=0,$level=0){	//无限级分类排序
		static $arr=array();
		foreach($info as $k=>$v){
			if($v['pid']==$pid){
				$v['level']=$level+1;
				$arr[]=$v;
				$this->cate_info_handle($info,$v['id'],$v['level']);
			}
		}
		return $arr;
	}
	public function cate_id_handle($info,$id){ //查找无限子孙
		static $arr=array();
		foreach($info as $k=>$v){
			if($v['pid']==$id){
				$arr[]=$v['id'];
				$this->cate_id_handle($info,$v['id']);
			}
		}
		$arr[]=$id;
		$arr=array_unique($arr);
		return $arr;
	}
	public function article_handle($id){	//面包屑导航
		$res=\think\Db::name('cate')->field('id,cate_name,pid')->select();
		$id=implode($id);
		$res=$this->article_handle2($res,$id);
		$res=array_reverse($res);
		return $res;
	}
	protected function article_handle2($info,$id){	//面包屑导航2
		static $arr=array();
		foreach($info as $k=>$v){
			if($v['id']==$id){
				$arr[]=$v;
				$this->article_handle2($info,$v['pid']);
			}
		}
		return $arr;
	}
}
