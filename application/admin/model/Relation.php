<?php
namespace app\admin\model;
use think\Model;
class Relation extends Model{
	protected static function init(){
		self::event('before_delete',function ($info){	//删除品牌前删除图片
			delete_img(FILE_RELATION.$info['relation_img']);
		});
	}
	protected $table='shop_category_relation';	//设置数据表
    public function __file(){	//处理图片上传
    	$file = request()->file('relation_img');
	    if($file){
	        $info = $file->move(FILE_RELATION);
	        if($info){
	            return $info->getSaveName();
	        }else{
	            echo $file->getError(); die;
	        }
	    }
    }
    public function handle($info){	//处理网址
    	if($info['relation_link'] && stripos($info['relation_link'],'http://')===false){	//处理网址未带 http://
    		$info['relation_link']='http://'.$info['relation_link'];
    	}
    	return $info;
    }
    public function list_handle($info){	//处理列表数据
    	foreach($info as $k=>$v){
    		switch($v['relation_type']){	//类型数据处理
    			case 1:
    			$info[$k]['relation_type']='词推荐';
    			break;
    			case 2:
    			$info[$k]['relation_type']='图推荐';
    			break;
    			case 3:
    			$info[$k]['relation_type']='图广告';
    		}
    	}
    	return $info;
    }
}
