<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Type extends Base{
	public function _initialize(){
		$model=model('type');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $result=$this->model->validate('type.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加类型成功',url('lists'));
    		}else{
    			$this->error('添加类型失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
    		$result=$this->model->validate('type.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改类型成功',url('lists'));
    		}else{
    			$this->error('修改类型失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('type')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('type')->select();
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
        Db::name('attr')->where(['pid'=>$id])->delete(); //删除属于该类型的属性
    	if($this->model->destroy($id)){
    		$this->success('删除类型成功');
    	}else{
    		$this->error('删除类型失败');
    	}
    }
}
