<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Conf extends Base{
	public function _initialize(){
		$model=model('conf');
		$this->model=$model;
	}
    public function index(){
        if(request()->ispost()){
            $data=input('post.');
            //处理图片上传
            foreach($_FILES as $k=>$v){
            if($v['name']!=''){
                $res=$this->model->where(['name'=>$k])->value('value');
                delete_img(FILE_CONF.$res);
            }
            $file=request()->file($k);
            if($file){
                $info=$file->move(FILE_CONF);
                if($info){
                    $data[$k]=$info->getSaveName();
                }else{
                    $file->getError(); die;
                }
            }}
            //处理图片上传
            $data=$this->model->handle_array($data);    //处理数组
            foreach($data as $k=>$v){
                $this->model->save(['value'=>$data[$k]],['name'=>$k]);
            }
            $this->success('保存成功',url('index'));
        }
        $res=$this->model->all();
        $this->assign('info',$res);
        return view();
    }
    public function add(){
    	if(request()->ispost()){
    		$data=input('post.');
            $data=$this->model->handles($data);    //数据处理
            $result=$this->model->validate('conf.add')->save($data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加配置成功',url('lists'));
    		}else{
    			$this->error('添加配置失败');
    		}
    	}
        // $this->add_edit_common();
    	return view();
    }

    public function edit(){
        if(request()->ispost()){
            $data=input('post.');
            $data=$this->model->handles($data);    //数据处理
            $result=$this->model->validate('conf.edit')->save($data,['id'=>$data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
            if($result){
                $this->success('修改配置成功',url('lists'));
            }else{
                $this->error('修改配置失败');
            }
        }
        $id=input('id');
        $res=Db::name('conf')->find($id);
        $this->assign('info',$res);
        return view();
    }
    public function lists(){
    	$res=$this->model->order('area asc,sort')->select();
        $res=$this->model->handle($res);    //数据加工
    	$this->assign('info',$res);
    	return view('list');
    }

    public function del(){
    	$id=input('id');
        $result=$this->model->destroy($id);
    	if($result){
    		$this->success('删除配置成功');
    	}else{
    		$this->error('删除配置失败');
    	}
    }

    public function ajax_sort(){    //列表 配置排序
        $conf_id=input('conf_id');
        $conf_val=input('conf_val');
        $res=Db::name('conf')->where(['id'=>$conf_id])->update(['sort'=>$conf_val]);
        if($res!==false){
            echo 1;
        }
    }
}
