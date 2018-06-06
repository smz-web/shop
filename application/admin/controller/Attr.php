<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Attr extends Base{
	public function _initialize(){
		$model=model('attr');
		$this->model=$model;
	}
    protected function type_id_error(){
        $type_id=input('type_id');
        if($type_id===null){
            $this->error('请选择商品类型',url('type/lists'));
        }
    }
    public function add(){
        $this->type_id_error();
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('attr.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加属性成功',url('lists',['type_id'=>input('type_id')]));
    		}else{
    			$this->error('添加属性失败');
    		}
    	}
        $this->add_edit();
    	return view();
    }
    protected function add_edit(){
        $res=Db::name('type')->select();
        $this->assign('info',$res);
    } 
    public function edit(){
        $this->type_id_error();
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handle($data);  //数据处理
    		$result=$this->model->validate('attr.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改属性成功',url('lists',['type_id'=>input('type_id')]));
    		}else{
    			$this->error('修改属性失败');
    		}
    	}
        $this->add_edit();
    	$id=input('id');
    	$res=Db::name('attr')->find($id);
    	$this->assign('oneself',$res);
    	return view();
    }
    public function lists(){
        $this->type_id_error();
        //到这里
    	$res=Db::name('attr')
        ->alias('a')
        ->join('type b','a.pid = b.id and a.pid = '.input('type_id'))
        ->field('a.*,b.type_name')
        ->order('sort asc')->select();
        $res=$this->model->handles($res);
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
        $this->type_id_error();
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除属性成功',url('lists',['type_id'=>input('type_id')]));
    	}else{
    		$this->error('删除属性失败');
    	}
    }
    public function ajax_sort(){    //列表 属性排序
        $attr_id=input('attr_id');
        $attr_val=input('attr_val');
        $res=Db::name('attr')->where(['id'=>$attr_id])->update(['sort'=>$attr_val]);
        if($res!==false){
            echo 1;
        }
    }
}
