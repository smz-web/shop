<?php
namespace app\admin\model;
use think\Model;
class Brand extends Model{
	protected static function init(){
		self::event('before_delete',function ($info){	//删除品牌前删除图片
			delete_img($info['brand_img']);
		});
	}
    public function __file(){	//处理图片上传
    	$file = request()->file('brand_img');
	    if($file){
	        $info = $file->move(FILE_BRAND);
	        if($info){
	            return $info->getSaveName();
	        }else{
	            echo $file->getError(); die;
	        }
	    }
    }
    public function handle($info){
    	if($info['brand_url'] && stripos($info['brand_url'],'http://')===false){	//处理网址未带 http://
    		$info['brand_url']='http://'.$info['brand_url'];
    	}
    	return $info;
    }
}
