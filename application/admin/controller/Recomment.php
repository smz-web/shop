<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Recomment extends Base{
	public function _initialize(){
		$model=model('recomment');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $result=$this->model->validate('recomment.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加推荐位成功',url('lists'));
    		}else{
    			$this->error('添加推荐位失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            $result=$this->model->validate('recomment.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改推荐位成功',url('lists'));
    		}else{
    			$this->error('修改推荐位失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('recomment')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=$this->model->order('rec_type')->select();
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除推荐位成功');
    	}else{
    		$this->error('删除推荐位失败');
    	}
    }
}
