<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Cate extends Base{
	public function _initialize(){
		$model=model('cate');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handles($data);    //数据处理
            $result=$this->model->validate('cate.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加栏目成功',url('lists'));
    		}else{
    			$this->error('添加栏目失败');
    		}
    	}
        $this->add_edit_common();
    	return view();
    }
    protected function add_edit_common(){
        $res=Db::name('cate')->select();
        $res=classify($res);    //添加层次
        $res=$this->model->addhandle($res); //排除不能添加子栏目的栏目
        $this->assign('info',$res);
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handles($data);    //数据处理
    		$result=$this->model->validate('cate.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改栏目成功',url('lists'));
    		}else{
    			$this->error('修改栏目失败');
    		}
    	}
        $this->add_edit_common();
    	$id=input('id');
    	$res=Db::name('cate')->find($id);
    	$this->assign('oneself',$res);
    	return view();
    }
    public function lists(){
    	$res=$this->model->order('sort asc')->select();
        $res=$this->model->handle($res);    //数据加工
        $res=classify($res);
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
        $res=Db::name('cate')->field('id,pid')->select();
        $res=family($res,$id);   //加上所有属于这个id的下级栏目
        $res=implode(',',$res);
        $result=Db::name('article')->where('cate_id','in',$res)->field('thumb')->select();
        foreach($result as $v){
            delete_img(FILE_ARTICLE.$v['thumb']);   //删除文章缩略图
        }
        Db::name('article')->where('cate_id','in',$res)->delete();  //删除文章
        $result=Db::name('cate')->where('id','in',$res)->delete();  //删除栏目
    	if($result){
    		$this->success('删除栏目成功');
    	}else{
    		$this->error('删除栏目失败');
    	}
    }
    public function ajax_sort(){    //列表 栏目排序
        $cate_id=input('cate_id');
        $cate_val=input('cate_val');
        $res=Db::name('cate')->where(['id'=>$cate_id])->update(['sort'=>$cate_val]);
        if($res!==false){
            echo 1;
        }
    }
}
