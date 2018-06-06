<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Nav extends Base{
	public function _initialize(){
		$model=model('nav');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('nav.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加导航成功',url('lists'));
    		}else{
    			$this->error('添加导航失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('nav.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改导航成功',url('lists'));
    		}else{
    			$this->error('修改导航失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('nav')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('nav')->order('nav_pos asc,sort')->select();
        $res=$this->model->list_handle($res);
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除导航成功');
    	}else{
    		$this->error('删除导航失败');
    	}
    }
    public function ajax_sort(){    //列表 导航排序
        $nav_id=input('link_id');
        $nav_val=input('link_val');
        $res=Db::name('nav')->where(['id'=>$nav_id])->update(['sort'=>$nav_val]);
        if($res!==false){
            echo 1;
        }
    }
}
