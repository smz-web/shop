<?php
namespace app\admin\model;
use think\Model;
class Article extends Model{
	protected static function init(){
		self::event('before_delete',function ($info){	//删除品牌前删除图片
			delete_img($info['thumb']);
		});
	}
	public function __file(){	//处理图片上传
    	$file = request()->file('thumb');
	    if($file){
	        $info = $file->move(FILE_ARTICLE);
	        if($info){
	            return $info->getSaveName();
	        }else{
	            echo $file->getError(); die;
	        }
	    }
    }
	public function handles($info){
		if($info['link'] && stripos($info['link'],'http://')==false){	//处理网址未带 http://
    		$info['link']='http://'.$info['link'];
    	}
    	if($info['keywords']){	//处理关键词，
			$info['keywords']=str_replace('，',',',$info['keywords']);
		}
		return $info;
	}
	public function handle($info){	//处理数据
		foreach($info as $k=>$v){
			switch($v['status']){
			case 1:
				$info[$k]['status']='显示';
				break;
			case 0:
				$info[$k]['status']='不显示';
			}
		}
	return $info;
	}
	public function addhandle($res){	//add数据处理
		static $arr;
		foreach($res as $k=>$v){
			if($v['cate_type']!==2){
				$arr[]=$v;
			}
		}
		return $arr;
	}
}
