<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Brand extends Base{
	public function _initialize(){
		$model=model('brand');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
    		$res=$this->model->__file();
    		$res!==null?$data['brand_img']=$res:'';	//处理文件上传
            $result=$this->model->validate('brand')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加品牌成功',url('lists'));
    		}else{
    			$this->error('添加品牌失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
    		$res=$this->model->__file();
    		$res!==null?$data['brand_img']=$res:'';	//处理文件上传
    		$result=$this->model->validate('brand')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改品牌成功',url('lists'));
    		}else{
    			$this->error('修改品牌失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('brand')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('brand')->order('brand_sort asc')->select();
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除品牌成功');
    	}else{
    		$this->error('删除品牌失败');
    	}
    }
    public function ajax_del(){	    //更改 品牌删除图片
    	$brand_id=input('brand_id');
    	$info=Db::name('brand')->where(['id'=>$brand_id])->field('brand_img')->find();
    	$info=implode($info);
    	$this->model->delete_img($info);
    	$res=Db::name('brand')->where(['id'=>$brand_id])->update(['brand_img'=>'']);
    	echo $res;
    }
    public function ajax_sort(){    //列表 品牌排序
        $brand_id=input('brand_id');
        $brand_val=input('brand_val');
        $res=Db::name('brand')->where(['id'=>$brand_id])->update(['brand_sort'=>$brand_val]);
        if($res){
            echo 1;
        }
    }
}
