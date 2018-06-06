<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Category extends Controller{
	public function category_info(){
        $category_info=model('category')->get_category_one(input('cate'));  //商品分类信息
        $relation_info=Db::name('category_relation')->select(); //商品关联信息
        $topic='';
        foreach($relation_info as $k=>$v){  //词推荐位
            if($v['relation_type']=='1' && $v['category_id']==input('cate')){
                if($v['relation_target']==2){   //打开方式
                    $topic.='<a href="'.$v['relation_link'].'" target="_blank">'.$v['relation_name'].'</a>';
                }else{
                    $topic.='<a href="'.$v['relation_link'].'">'.$v['relation_name'].'</a>';
                }
            }
        }
        if($topic==''){ //如果没有
            $topic='<a href="#" >暂无数据</a>';
        }
        $cat='';
        foreach($category_info as $k=>$v){  //子导航
            $cat.='
            <dl class="dl_fore1">
                <dt><a href="'.url('Category/index',['id'=>$v['id']]).'" target="_blank">'.$v['cate_name'].'</a></dt>
                <dd>';
            foreach($v['son_one'] as $k2=>$v2){
                    $cat.='<a href="'.url('index/Category/index',['id'=>$v2['id']]).'" target="_blank">'.$v2['cate_name'].'</a>';
            }
            $cat.='</dd>
            </dl>';   
        }
        $cat.='<div class="item-brands">
            <ul>
                            </ul>
        </div>
        <div class="item-promotions">
                    </div>
        ';
    $brands='<div class="cate-brand">'; //图推荐
    foreach($relation_info as $k=>$v){
        if($v['relation_type']==2 && $v['category_id']==input('cate')){
                if($v['relation_target']==2){   //打开方式
                    $brands.='<div class="img"><a href="'.$v['relation_link'].'" target="_blank" title="'.$v['relation_name'].'"><img src="'.config('view_replace_str.FILE_RELATION').$v['relation_img'].'"></a></div>';
                }else{
                    $brands.='<div class="img"><a href="'.$v['relation_link'].'" title="'.$v['relation_name'].'"><img src="'.config('view_replace_str.FILE_RELATION').$v['relation_img'].'"></a></div>';
                }
        }
    }
    $brands.='</div>';
    //广告图
    foreach($relation_info as $k=>$v){
        if($v['relation_type']==3 && $v['category_id']==input('cate')){
                if($v['relation_target']==2){   //打开方式
                    $brands.='<div class="cate-promotion">
                                 <a href="'.$v['relation_link'].'" title="'.$v['relation_name'].'" target="_blank"><img src="'.config('view_replace_str.FILE_RELATION').$v['relation_img'].'" width="199" height="97" alt="'.$v['relation_name'].'"></a>
                              </div>';
                }else{
                    $brands.='<div class="cate-promotion">
                                 <a title="'.$v['relation_name'].'" href="'.$v['relation_link'].'" ><img src="'.config('view_replace_str.FILE_RELATION').$v['relation_img'].'" width="199" height="97" alt="'.$v['relation_name'].'"></a>
                              </div>';
                }
        }
    }
    // $brands='
    // <div class="cate-brand">
    //                 <div class="img"><a href="#" target="_blank" title="金士顿"><img src="data/brandlogo/1490039286075654490.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="同庆和堂"><img src="data/brandlogo/1490072850306019115.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="ELLE HOME"><img src="data/brandlogo/1490072313895957648.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="她他/tata"><img src="data/brandlogo/1490072329183966195.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="梦特娇"><img src="data/brandlogo/1490072344340492758.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="阿迪达斯"><img src="data/brandlogo/1490072384627679069.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="猫人"><img src="data/brandlogo/1490072399542595828.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="Dior"><img src="data/brandlogo/1490072417755830176.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="同仁堂"><img src="data/brandlogo/1490072746651935979.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="喜瑞"><img src="data/brandlogo/1490072756032175204.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="汤臣倍健"><img src="data/brandlogo/1490072777790374054.jpg"></a></div>
    //                 <div class="img"><a href="#" target="_blank" title="养生堂"><img src="data/brandlogo/1490072787223453617.jpg"></a></div>
    //         </div>
    //     <div class="cate-promotion">
    //             <a href="#" target="_blank"><img src="data/afficheimg/1490847672639256000.jpg" width="199" height="97"></a>
    //         </div>
    // ';
		return json([
			'topic_content'=>$topic,
			'cat_content'=>$cat,
			'brands_ad_content'=>$brands,
			'cat_id'=>input('cate')
		]);
	}
	
}
