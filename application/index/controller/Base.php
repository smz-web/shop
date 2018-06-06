<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Base extends Controller{
	public function _initialize(){
		$this->foot_function();	//底部信息
		$this->info_function();	//基础信息
		$this->category_function();	//商品栏目
	}
	protected function category_function(){	//所有商品分类
		$category=model('category')->category_info();
		$this->assign('category_info',$category);
	}
	protected function foot_function(){	//底部信息
		$res=Db::name('cate')->where(['show_nav'=>1])->order('sort asc')->select();	//底部显示的栏目
		$this->assign('foot_cate_info',$res);	//尾部栏目
		$info=Db::name('article')->order('sort asc')->select();
		$this->assign('article_info',$info);	//所有文章
	}
	protected function info_function(){
		$info=Db::name('nav')->select();	//导航信息
		$this->assign('nav_info',$info);
		$info=Db::name('conf')->select();	//配置信息
		foreach($info as $k=>$v){
			$this->assign('conf_'.$v['name'],$v['value']);
		}
	}

}
