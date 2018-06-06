<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Article extends Base{
	public function _initialize(){
		$model=model('article');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handles($data); //数据处理
            $res=$this->model->__file();    //处理文件上传
            $res!==null?$data['thumb']=$res:'';   //存入data
            $result=$this->model->validate('article.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加文章成功',url('lists'));
    		}else{
    			$this->error('添加文章失败');
    		}
    	}
        $this->add_edit_common();
    	return view();
    }
    protected function add_edit_common(){
        $res=Db::name('cate')->select();
        $res=classify($res);    //添加层次
        $res=$this->model->addhandle($res); //排除发布文章的栏目
        $this->assign('info',$res);
    }
    public function edit(){
        if(request()->ispost()){
            $data=input('post.');
            $data=$this->model->handles($data); //数据处理
            if(isset($_FILES['thumb']['tmp_name'])){   //如果有上传图片/删除旧的
                $thumb=$this->model->where(['id'=>$data['id']])->value('thumb');
                $thumb=FILE_ARTICLE . $thumb;
                delete_img($thumb);
            }
            $res=$this->model->__file();    //处理文件上传
            $res!==null?$data['thumb']=$res:'';   //存入data
            $result=$this->model->validate('article.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
            if($result!==false){
                $this->success('修改文章成功',url('lists'));
            }else{
                $this->error('修改文章失败');
            }
        }
        $id=input('id');
        $res=$this->model->get($id);
        $this->assign('oneself',$res);
        $this->add_edit_common();
        return view();
    }
    public function lists(){
        $res=Db::name('article')
        ->alias('a')
        ->join('cate b','a.cate_id = b.id')
        ->field('a.*,b.cate_name')
        ->order('b.sort asc,a.sort')
        ->select();   
        $res=$this->model->handle($res);    //数据加工
    	$this->assign('info',$res);
    	return view('list');
    }
    public function del(){
    	$id=input('id');
        $result=Db::name('article')->where(['id'=>$id])->delete();
    	if($result){
    		$this->success('删除文章成功');
    	}else{
    		$this->error('删除文章失败');
    	}
    }
    public function ajax_sort(){    //列表 文章排序
        $text_id=input('text_id');
        $text_val=input('text_val');
        $res=Db::name('article')->where(['id'=>$text_id])->update(['sort'=>$text_val]);
        if($res!==false){
            echo 1;
        }
    }
    public function ajax_del(){     //更改 文章删除图片
        $text_id=input('text_id');
        $info=Db::name('article')->where(['id'=>$text_id])->field('thumb')->find();
        $info=implode($info);
        $info=FILE_ARTICLE.$info;
        delete_img($info);
        $res=Db::name('article')->where(['id'=>$text_id])->update(['thumb'=>'']);
        echo $res;
    }
}
