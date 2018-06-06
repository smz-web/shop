<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Relation extends Base{
	public function _initialize(){
		$model=model('relation');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $res=$this->model->__file();    //处理文件上传
    		$res!==null?$data['relation_img']=$res:'';   //存入data
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('relation.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加栏目关联成功',url('lists'));
    		}else{
    			$this->error('添加栏目关联失败');
    		}
    	}
        $res=Db::name('category')->where(['pid'=>0])->select();
        $this->assign('info',$res); //商品分类信息
    	return view();
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            $res=$this->model->__file();    //处理文件上传
            $res!==null?$data['relation_img']=$res:'';   //存入data
            $data=$this->model->handle($data);  //数据处理
            $result=$this->model->validate('relation.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改栏目关联成功',url('lists'));
    		}else{
    			$this->error('修改栏目关联失败');
    		}
    	}
        $res=Db::name('category')->where(['pid'=>0])->select();
        $this->assign('info',$res); //商品分类信息
    	$id=input('id');
    	$res=Db::name('category_relation')->find($id);
    	$this->assign('oneself',$res);
    	return view();
    }
    public function lists(){
    	$res=Db::name('category_relation')
        ->alias('a')
        ->join('category b','a.category_id = b.id')
        ->order('relation_type asc,relation_sort')
        ->field('a.*,b.cate_name')
        ->select();
        $res=$this->model->list_handle($res);   //数据处理
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除栏目关联成功');
    	}else{
    		$this->error('删除栏目关联失败');
    	}
    }
    public function ajax_del(){     //更改 删除图片
        $text_id=input('text_id');
        $info=Db::name('category_relation')->where(['id'=>$text_id])->field('relation_img')->find();
        $info=implode($info);
        $info=FILE_RELATION.$info;
        delete_img($info);
        $res=Db::name('category_relation')->where(['id'=>$text_id])->update(['relation_img'=>'']);
        echo $res;
    }
    // public function ajax_sort(){    //列表 栏目关联排序
    //     $relation_id=input('relation_id');
    //     $relation_val=input('relation_val');
    //     $res=Db::name('relation')->where(['id'=>$relation_id])->update(['sort'=>$relation_val]);
    //     if($res!==false){
    //         echo 1;
    //     }
    // }
}
