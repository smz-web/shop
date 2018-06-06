<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Category extends Model{
	protected static function init(){
		self::event('after_insert',function($infos){	//添加商品后
			//处理推荐位
			if(input('rec_id/a')){
				foreach(input('rec_id/a') as $k=>$v){
				Db::name('recomment_middle')->insert(['rec_id'=>$v,'pid'=>$infos['id'],'type'=>2]);
				}
			}});

		self::event('before_update',function($infos){	//更新前
			//处理推荐位
			Db::name('recomment_middle')->where(['pid'=>$infos['id']])->delete();
			if(input('rec_id/a')){
				foreach(input('rec_id/a') as $k=>$v){
				Db::name('recomment_middle')->insert(['rec_id'=>$v,'pid'=>$infos['id'],'type'=>1]);
				}
			}
		});   
	}
	public function handles($info){
		if($info['keywords']){	//处理关键词，
			$info['keywords']=str_replace('，',',',$info['keywords']);
		}
		unset($info['rec_id']);
		return $info;
	}
	public function handle($info){	//处理数据
		foreach($info as $k=>$v){
			switch($v['show_nav']){
			case 1:
				$info[$k]['show_nav']='显示';
				break;
			case 0:
				$info[$k]['show_nav']='不显示';
			}
		}
	return $info;
	}
    public function __file(){	//处理图片上传
	$file = request()->file('cate_img');
    if($file){
        $info = $file->move(FILE_CATE);
        if($info){
            return $info->getSaveName();
        }else{
            echo $file->getError(); die;
        }
    }
	}
}
