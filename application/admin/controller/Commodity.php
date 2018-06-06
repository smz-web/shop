<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class commodity extends Base{
	public function _initialize(){
		$model=model('commodity');
		$this->model=$model;
	}
    public function add(){
    	if(request()->ispost()){
            $commodity_data=[   //主表数据
                'name'  =>  input('name'),  //商品名称
                'category_id'  =>  input('category_id'),    //所属分类
                'brand_id'  =>  input('brand_id'), 
                 //所属商品
                'market_price'  =>  input('market_price'),  //市场价
                'ours_price'  =>  input('ours_price'),  //商品价格
                'status'  =>  input('status'),  //是否上架
                'content'  =>  input('content'),    //商品介绍
                'sort'    =>  input('sort'),
                'code'  =>  time(),    //产品编号
                'type_id'   =>  input('type_id'),
            ];
            $result=$this->model->validate('commodity.add')->save($commodity_data);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result){
    			$this->success('添加商品成功',url('lists'));
    		}else{
    			$this->error('添加商品失败');
    		}
    	}
        $this->add_edit();
    	return view();
    }
    protected function add_edit(){
        $res=Db::name('brand')->order('brand_sort asc')->select();   //商品表
        $this->assign('brand_info',$res);
        $res=Db::name('category')->order('sort asc')->select();   //分类表
        $this->assign('cate_info',$res);
        $res=Db::name('member_level')->order('bottom_integral asc')->select();   //会员级别表
        $this->assign('level_info',$res);
        $res=Db::name('type')->select();   //类型表
        $this->assign('type_info',$res);
        $res=Db::name('recomment')->select();   //推荐位
        $this->assign('recomment_info',$res);
    }
    public function edit(){
    	if(request()->ispost()){
            $commodity_data=[   //主表数据
                'id'    =>  input('id'),
                'name'  =>  input('name'),  //商品名称
                'category_id'  =>  input('category_id'),    //所属分类
                'brand_id'  =>  input('brand_id'), //所属品牌
                'market_price'  =>  input('market_price'),  //市场价
                'ours_price'  =>  input('ours_price'),  //商品价格
                'status'  =>  input('status'),  //是否上架
                'content'  =>  input('content'),    //商品介绍
                'sort'    =>  input('sort'),
                // 'code'  =>  time(),    //产品编号
            ];
    		$result=$this->model->validate('commodity.edit')->save($commodity_data,['id'=>$commodity_data['id']]);
            if($result===false){
                $this->error($this->model->getError());
            }
    		if($result!==false){
    			$this->success('修改商品成功',url('lists'));
    		}else{
    			$this->error('修改商品失败');
    		}
    	}
    	$id=input('id');
    	$result=Db::name('commodity')->find($id);
    	$this->assign('info',$result); //商品主信息
        $res=Db::name('commodity_mprice')->where(['commodity_id'=>$id])->select();  
        $this->assign('mprice_info',$res);  //商品会员价格信息
        $res=Db::name('commodity_picture')->where(['commodity_id'=>$id])->select();
        $this->assign('picture_info',$res); //商品相册信息
        $res=Db::name('type')->select();    
        $this->assign('type_info',$res);    //商品类型信息
        $res=Db::name('attr')->where(['pid'=>$result['type_id']])->select();
        $this->assign('attr_infos',$res);    //商品属性信息
        $res=Db::name('recomment_middle')->where(['pid'=>$id])->select();
        if(!empty($res)){
            foreach($res as $k=>$v){
            $recomment[]=$v['rec_id'];
            }
        }else{
            $recomment=array();
        }
        $this->assign('one_recomment_info',$recomment);   //推荐位
        $res=Db::name('commodity_attr')
        ->alias('a')
        ->join('attr b','a.attr_id = b.id and a.commodity_id = '.$id)
        ->field('a.*,b.*,a.id as ajax_id')
        ->order('attr_id asc')
        ->select();
        $this->assign('attr_info',$res);    //该商品属性
        $this->add_edit();
    	return view();
    }
    public function lists(){
    	$res=Db::name('commodity')
        ->alias('a')
        ->join('category b','a.category_id = b.id') //栏目
        ->join('brand c','a.brand_id = c.id')   //品牌
        ->field('a.*,b.cate_name,c.brand_name')  
        ->order('sort asc')
        ->select();
        $res=$this->model->handle($res);    //处理数据
    	$this->assign('info',$res);
    	return view('list');
    }
    public function stock(){    //商品库存
        $id=input('id');
        if(request()->ispost()){
            $data=input('post.');
            //     $data=$this->model->stock_handles($data);    //处理
            //     foreach($data as $k=>$v){
            //         $v_handle=[
            //             'id'=>$v['id'],
            //             'commodity_id'=>$id,
            //             'value'=>$v['stock'],
            //             'attr_id'=>$v['arr'],
            //         ];
            //         Db::name('commodity_stock')->update($v_handle);
            //     }
            //     $this->success('修改商品库存成功',url('lists'));
            // }else{  //添加库存
                $data=$this->model->stock_handle($data);    //处理
                Db::name('commodity_stock')->where(['commodity_id'=>$id])->delete();
                foreach($data as $k=>$v){
                    $v_handle=[
                        'commodity_id'=>$id,
                        'value'=>$v['stock'],
                        'attr_id'=>$v['arr'],
                    ];
                    Db::name('commodity_stock')->insert($v_handle);
                }
                $this->success('保存商品库存成功',url('lists'));
            
        }
        $res=Db::name('commodity_attr')
        ->alias('a')
        ->join('attr b','a.attr_id = b.id and b.attr_type = 2 and a.commodity_id ='.$id)
        ->field('a.id,a.attr_value,b.attr_name')
        ->select();
        if(!empty($res)){
            $res=$this->model->handles($res);  //单选种类
        }
        $oneself=Db::name('commodity_stock')->where(['commodity_id'=>$id])->select();
        $this->assign([
            'info'=>$res,   //基础数据
            'oneself'=>$oneself,    //修改时 当前数据
        ]);
        return view();
    }
    public function del(){
    	$id=input('id');
    	if($this->model->destroy($id)){
    		$this->success('删除商品成功');
    	}else{
    		$this->error('删除商品失败');
    	}
    }
    public function ajax_del(){	    //更改 商品删除图片
    	$pic=input('pic');
        $res=Db::name('commodity_picture')->where(['picture'=>$pic])->find();
        delete_img(FILE_COMMODITY.$res['picture']);
        delete_img(FILE_COMMODITY.$res['big_picture']);
        delete_img(FILE_COMMODITY.$res['medium_picture']);
        delete_img(FILE_COMMODITY.$res['small_picture']);
        $res=Db::name('commodity_picture')->where(['picture'=>$pic])->delete();
        if($res){
            echo 1;
        }
    }
    public function ajax_del2(){     //更改 商品删除图片
        $id=input('id');
        $res=Db::name('commodity')->field('picture,big_picture,medium_picture,small_picture')->find($id);
        foreach($res as $k=>$v){
            delete_img(FILE_COMMODITY.$v);
        }
        $res=Db::name('commodity')->update([
            'id'=>$id,
            'picture'=>'',
            'big_picture'=>'',
            'medium_picture'=>'',
            'small_picture'=>'',
        ]);
        if($res){
            echo 1;
        }
    }
    // public function ajax_sort(){    //列表 商品排序
    //     $commodity_id=input('commodity_id');
    //     $commodity_val=input('commodity_val');
    //     $res=Db::name('commodity')->where(['id'=>$commodity_id])->update(['commodity_sort'=>$commodity_val]);
    //     if($res!==false){
    //         echo 1;
    //     }
    // }
    public function ajax_type(){    //动态切换类型下的属性
        $type_id=input('type_id');
        $res=Db::name('attr')->where(['pid'=>$type_id])->select();
        return $res;
    }
    public function ajax_edit_del(){    //编辑 删除属性
        $ajax_id=input('ajax_id');
        $res=Db::name('commodity_attr')->where(['id'=>$ajax_id])->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function ajax_edit_add(){    //编辑 添加属性
        $ajax_id=input('ajax_id');
        $prefix=config('database.prefix');
        $sql="insert into {$prefix}commodity_attr(commodity_id,attr_id,attr_value,attr_price) select commodity_id,attr_id,attr_value,attr_price from {$prefix}commodity_attr where id = {$ajax_id}";
        $res=Db::execute($sql);
        if($res){
            echo 1;
        }else{
            echo 2;
        };
        echo $ajax_id;
    }
}
