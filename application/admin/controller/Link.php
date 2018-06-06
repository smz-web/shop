<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Link extends Base{
	public function _initialize(){
		$model=model('link');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
      //       $res=$this->model->__file();    //处理文件上传
    		// $res!==null?$data['link_img']=$res:'';   //存入data
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('link.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加友情链接成功',url('lists'));
    		}else{
    			$this->error('添加友情链接失败');
    		}
    	}
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('link.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改友情链接成功',url('lists'));
    		}else{
    			$this->error('修改友情链接失败');
    		}
    	}
    	$id=input('id');
    	$res=Db::name('link')->find($id);
    	$this->assign('info',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('link')->order('sort asc')->select();
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除友情链接成功');
    	}else{
    		$this->error('删除友情链接失败');
    	}
    }
    public function ajax_sort(){    //列表 友情链接排序
        $link_id=input('link_id');
        $link_val=input('link_val');
        $res=Db::name('link')->where(['id'=>$link_id])->update(['sort'=>$link_val]);
        if($res!==false){
            echo 1;
        }
    }
}
