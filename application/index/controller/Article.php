<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Db;
class Article extends Base{
	public function _initialize(){
		parent::_initialize();	//调用父类构造
		$model=model('Article');
		$this->model=$model;
	}
    public function listing(){	//文章列表 
    	$id=input('id');
    	if(!isset($id)){	//默认为1
    		$id=1;
    	}
    	$this->cate_info($id);
    	return view();
    }
    public function article(){	//文章内容
    	$this->cate_info();
    	$id=input('id');
		if(empty($id)){
			$this->error('非法访问');
		}
		//面包屑导航
		$res=Db::name('article')->field('cate_id')->find($id);
		$res=$this->model->article_handle($res);
		$this->assign('navigation',$res);
		//当前栏目信息
		$res=$this->article_info($id);
    	return view();
    }
	protected function cate_info($id=1){	//栏目相关信息
		$cate_name=Db::name('cate')->field('cate_name')->find($id);
		$cate_name=implode($cate_name);
		$this->assign('id_cate_name',$cate_name);
		$res=Db::name('cate')->order('sort asc')->select();	//所有栏目信息
		$result=$this->model->cate_info_handle($res);	//分类排序
		$this->assign('cate_info',$result);
		$id=$this->model->cate_id_handle($res,$id);	//所有后代id
		$result=Db::name('article')->where('cate_id','in',$id)->select();	
		$this->assign('article_info',$result);	//所有后代文章
	}
	protected function article_info($id){	//文章相关信息
		$res=Db::name('article')->find($id);
		$this->assign('own_info',$res);
	}
}
