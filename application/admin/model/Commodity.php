<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Commodity extends Model{
	protected static function init(){
		self::event('before_insert',function ($infos){	//添加添加商品前
			//处理商品主图
			$file=request()->file('picture');
			$time=date("Ymd");
			if($file){
				$info=$file->move(FILE_COMMODITY);	//原图
				if($info){
					$name=$info->getFilename();
					$infos->picture=$time.'/'.$name;
					$data['picture']=$time.'/'.$name;	//原图
					$image=\think\Image::open(FILE_COMMODITY.$time.'/'.$name);
					$infos->big_picture=$time.'/big_'.$name; 	//大图
					$image->thumb(500,500)->save(FILE_COMMODITY.$time.'/big_'.$name);
					$infos->medium_picture=$time.'/medium_'.$name; 	//中图
					$image->thumb(300,300)->save(FILE_COMMODITY.$time.'/medium_'.$name);
					$infos->small_picture=$time.'/small_'.$name;		//小图
					$image->thumb(100,100)->save(FILE_COMMODITY.$time.'/small_'.$name);
				}
			}
		});
		self::event('after_insert',function($infos){	//添加商品后
			//处理推荐位
			if(input('rec_id/a')){
				foreach(input('rec_id/a') as $k=>$v){
				Db::name('recomment_middle')->insert(['rec_id'=>$v,'pid'=>$infos['id'],'type'=>1]);
				}
			}
			//处理会员价格表
			foreach(input('level/a') as $k=>$v){
				if(!empty($v)){
					$data['commodity_id']=$infos['id'];
					$data['level_id']=$k;
					$data['member_price']=$v;
					Db::name('commodity_mprice')->insert($data);
				}
			}
			//处理商品图片
			$data=null;
			$time=date("Ymd");
			$file=request()->file('picture_arr');
			$data['commodity_id']=$infos['id'];
			foreach($file as $v){
				$info=$v->move(FILE_COMMODITY);
				if($info){
					$name=$info->getFilename();
					$data['picture']=$time.'/'.$name;	//原图
					$image=\think\Image::open(FILE_COMMODITY.$time.'/'.$name);
					$data['big_picture']=$time.'/big_'.$name;	//大图
					$image->thumb(500,500)->save(FILE_COMMODITY.$time.'/big_'.$name);
					$data['medium_picture']=$time.'/medium_'.$name;	//中图
					$image->thumb(300,300)->save(FILE_COMMODITY.$time.'/medium_'.$name);
					$data['small_picture']=$time.'/small_'.$name;		//小图
					$image->thumb(100,100)->save(FILE_COMMODITY.$time.'/small_'.$name);
					Db::name('commodity_picture')->insert($data);
				}
			}
			//处理商品属性
			//唯一类型
			$data=input('attr/a');
			if(!empty($data)){
				foreach($data as $k=>$v){
				if($v==null){
					$v=0;
				}
				Db::name('commodity_attr')
				->insert(['commodity_id'=>$infos['id'],'attr_id'=>$k,'attr_value'=>$v]);
				}
			}
		    //单选类型
		    //处理价格
		    $price=input('price/a');
		    if(!empty($price)){
		    	$i=0;
			foreach(input('attr_arr/a') as $k=>$v){
					if(is_array($v)){	//如果有多个执行
						foreach($v as $k2=>$v2){
							if($price[$i]==null){
								$price[$i]=0;
							}
							Db::name('commodity_attr')
							->insert([
							'commodity_id'=>$infos['id'],
							'attr_id'=>$k,
							'attr_value'=>$v2,
							'attr_price'=>$price[$i]
							]);
							$i++;
						}
					}else{
						Db::name('commodity_attr')
						->insert([
						'commodity_id'=>$infos['id'],
						'attr_id'=>$k,
						'attr_value'=>$v,
						'attr_price'=>$price[$i]
						]);
						$i++;
					}
			}
		    }
		});
		self::event('before_delete',function($info){	//删除前
			delete_img(FILE_COMMODITY.$info['picture']);	//删除原图
			delete_img(FILE_COMMODITY.$info['big_picture']);	//删除大图
			delete_img(FILE_COMMODITY.$info['medium_picture']);	//删除中图
			delete_img(FILE_COMMODITY.$info['small_picture']);	//删除小图
		});
		self::event('after_delete',function($info){		//删除后
			Db::name('commodity_attr')->where(['commodity_id'=>$info['id']])->delete();	
			//删除品牌
			Db::name('commodity_mprice')->where(['commodity_id'=>$info['id']])->delete();
			//删除会员特价
			Db::name('commodity_stock')->where(['commodity_id'=>$info['id']])->delete();
			//删除库存
			$res=Db::name('commodity_picture')
			->where(['commodity_id'=>$info['id']])
			->select();	
			foreach($res as $k=>$v){
				delete_img(FILE_COMMODITY.$v['picture']);	//删除原图
				delete_img(FILE_COMMODITY.$v['big_picture']);	//删除大图
				delete_img(FILE_COMMODITY.$v['medium_picture']);	//删除中图
				delete_img(FILE_COMMODITY.$v['small_picture']);	//删除小图
			}
			//删除商品相册图片
			Db::name('commodity_picture')->where(['commodity_id'=>$info['id']])->delete();
			//删除商品相册记录
		});
		self::event('before_update',function($infos){	//更新前
			$file=request()->file('picture');
			$time=date("Ymd");
			if($file){
				//删除旧主图
				$arr=Db::name('commodity')
				->field('picture,big_picture,medium_picture,small_picture')
				->find(input('id'));
				foreach($arr as $k=>$v){
					delete_img(FILE_COMMODITY.$v);
				}
				//上传新主图
				$info=$file->move(FILE_COMMODITY);	//原图
				if($info){
					$name=$info->getFilename();
					$infos->picture=$time.'/'.$name;
					$data['picture']=$time.'/'.$name;	//原图
					$image=\think\Image::open(FILE_COMMODITY.$time.'/'.$name);
					$infos->big_picture=$time.'/big_'.$name; 	//大图
					$image->thumb(500,500)->save(FILE_COMMODITY.$time.'/big_'.$name);
					$infos->medium_picture=$time.'/medium_'.$name; 	//中图
					$image->thumb(300,300)->save(FILE_COMMODITY.$time.'/medium_'.$name);
					$infos->small_picture=$time.'/small_'.$name;		//小图
					$image->thumb(100,100)->save(FILE_COMMODITY.$time.'/small_'.$name);
				}
			}
			//处理推荐位
			Db::name('recomment_middle')->where(['pid'=>$infos['id']])->delete();
			if(input('rec_id/a')){
				foreach(input('rec_id/a') as $k=>$v){
				Db::name('recomment_middle')->insert(['rec_id'=>$v,'pid'=>$infos['id'],'type'=>1]);
				}
			}
			//处理会员价格表
			Db::name('commodity_mprice')->where(['commodity_id'=>input('id')])->delete();
			foreach(input('level/a') as $k=>$v){
				if(!empty($v)){
					$data['commodity_id']=$infos['id'];
					$data['level_id']=$k;
					$data['member_price']=$v;
					Db::name('commodity_mprice')->insert($data);

				}
			}
			//处理商品属性
			//唯一类型
			$data=input('attr/a');
			if(!empty($data)){
				foreach($data as $k=>$v){
				if($v==null){
					$v=0;
				}
				Db::name('commodity_attr')
				->update(['id'=>$k,'attr_value'=>$v]);
				}
			}
		    //单选类型
		    $price=input('price/a');
		    if(!empty($price)){
		    	$i=0;
			foreach(input('attr_arr/a') as $k=>$v){
						foreach($v as $k2=>$v2){
							if($price[$i]==null){
								$price[$i]=0;
							}
							Db::name('commodity_attr')
							->update([
							'id'=>$k2,
							'attr_value'=>$v2,
							'attr_price'=>$price[$i]
							]);
							$i++;
						}
				}
		    }
			//处理新添加的商品图片
			$data=null;
			$time=date("Ymd");
			$file=request()->file('picture_arr');
			$data['commodity_id']=$infos['id'];
			foreach($file as $v){
				$info=$v->move(FILE_COMMODITY);
				if($info){
					$name=$info->getFilename();
					$data['picture']=$time.'/'.$name;	//原图
					$image=\think\Image::open(FILE_COMMODITY.$time.'/'.$name);
					$data['big_picture']=$time.'/big_'.$name;	//大图
					$image->thumb(500,500)->save(FILE_COMMODITY.$time.'/big_'.$name);
					$data['medium_picture']=$time.'/medium_'.$name;	//中图
					$image->thumb(300,300)->save(FILE_COMMODITY.$time.'/medium_'.$name);
					$data['small_picture']=$time.'/small_'.$name;		//小图
					$image->thumb(100,100)->save(FILE_COMMODITY.$time.'/small_'.$name);
					Db::name('commodity_picture')->insert($data);
				}
			}
		});
	}
	public function handle($info){
		foreach($info as $k=>$v){
			switch($v['status']){
			case 1:
			$info[$k]['status']='上架';
			break;
			default:
			$info[$k]['status']='不上架';
			}
		}
		return $info;
	}
	public function handles($info){	//数据处理
		foreach($info as $k=>$v){
			$name[]=$v['attr_name'];
		}
		//所有属性
		$name=array_unique($name);
		//格式预转
		foreach($name as $k=>$v){	
			$name[$k]=[
				'name'=>$v,
				'value'=>[],
			];
		}
		foreach($info as $k=>$v){
			foreach($name as $k2=>$v2){
				if($v['attr_name']==$v2['name']){	//如果名字相同的执行
					$name[$k2]['value'][$v['id']]=$v['attr_value'];	//值
					$name[$k2]=[
						'name'=>$name[$k2]['name'],
						'value'=>$name[$k2]['value'],		//加入值
					];
				}
			}
		}
		return $name;
	}
	public function stock_handle($info){	//库存数据处理
		$i=0;
		$num=count($info['price']);
		while($num>$i){
			foreach($info as $k=>$v){
				if($k!='price'){
					$arr[$i]['arr'][]=$v[$i];	//所属属性
				}
			}
			$i++;
		};
		foreach($arr as $k=>$v){
			$arr[$k]['stock']=$info['price'][$k];	//加入数量
			$arr[$k]['arr']=implode(',',$v['arr']);	//加入所属属性
		}
		return $arr;
	}
}