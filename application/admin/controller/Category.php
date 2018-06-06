<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Category extends Base{
	public function _initialize(){
		$model=model('category');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $this->model->__file()!==null?$data['cate_img']:'';   //处理图片
            $data=$this->model->handles($data);    //数据处理
            $result=$this->model->validate('category.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加分类成功',url('lists'));
    		}else{
    			$this->error('添加分类失败');
    		}
    	}
        $this->add_edit_common();
    	return view();
    }
    protected function add_edit_common(){
        $res=Db::name('recomment')->select();   //推荐位
        $this->assign('recomment_info',$res);
        $res=Db::name('category')->select();
        $res=classify($res);    //添加层次
        $this->assign('info',$res);
    }
    public function edit(){
    	if(request()->ispost()){
    		$data=input('post.');
            if($_FILES['cate_img']['tmp_name']){   //如果有上传图片/删除旧的
                $thumb=$this->model->where(['id'=>$data['id']])->value('cate_img');
                $thumb=FILE_CATE . $thumb;
                delete_img($thumb);
            }
            $res=$this->model->__file();
            $res!==null?$data['cate_img']=$res:'';   //处理图片
            $data=$this->model->handles($data);    //数据处理
    		$result=$this->model->validate('category.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改分类成功',url('lists'));
    		}else{
    			$this->error('修改分类失败');
    		}
    	}
        $this->add_edit_common();
    	$id=input('id');
    	$res=Db::name('category')->find($id);
    	$this->assign('oneself',$res); //旧信息
        $res=Db::name('recomment_middle')->where(['pid'=>$id])->select();
        if(!empty($res)){
            foreach($res as $k=>$v){
            $recomment[]=$v['rec_id'];
            }
        }else{
            $recomment=array();
        }
        $this->assign('one_recomment_info',$recomment);   //推荐位
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
        $res=Db::name('category')->field('id,pid')->select();
        $res=family($res,$id);   //加上所有属于这个id的下级分类
        $res=implode(',',$res);
        $res=Db::name('category')->where('id','in',$res)->field('id,cate_img,pid')->select();
        foreach($res as $v){
            delete_img(FILE_CATE.$v['cate_img']);   //删除分类缩略图
        }
        foreach($res as $k=>$v){
            $result=Db::name('category')->where(['id'=>$v['id']])->delete();  //删除分类
        }
    	$this->success('删除分类成功');
    }
    public function ajax_sort(){    //列表 分类排序
        $cate_id=input('cate_id');
        $cate_val=input('cate_val');
        $res=Db::name('category')->where(['id'=>$cate_id])->update(['sort'=>$cate_val]);
        if($res!==false){
            echo 1;
        }
    }
    public function ajax_del(){     //更改 文章删除图片
        $text_id=input('text_id');
        $info=Db::name('category')->where(['id'=>$text_id])->field('cate_img')->find();
        $info=implode($info);
        $info=FILE_CATE.$info;
        delete_img($info);
        $res=Db::name('category')->where(['id'=>$text_id])->update(['cate_img'=>'']);
        echo $res;
    }
}
