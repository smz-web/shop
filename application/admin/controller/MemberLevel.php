<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class MemberLevel extends Base{
	public function _initialize(){
		$model=model('member_level');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            if($data['top_integral']<$data['bottom_integral']){
                $this->error('最低积分必须高于最高积分!');
            }
            $result=$this->model->validate('member_level.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加会员级别成功',url('lists'));
    		}else{
    			$this->error('添加会员级别失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
    		$result=$this->model->validate('member_level.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改会员级别成功',url('lists'));
    		}else{
    			$this->error('修改会员级别失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('member_level')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('member_level')->order('bottom_integral asc')->select();
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除会员级别成功');
    	}else{
    		$this->error('删除会员级别失败');
    	}
    }
}
