<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Commodity extends Validate{
	protected $rule=[
        'name'    =>  'require|unique:commodity,id^name',
        'category_id'    =>  'require',
        'brand_id'    =>  'require',
        'ours_price'    =>  'require',
        'status'    =>  'require',
        'content'    =>  'require',
    ];
    protected $message=[
        'name.require'    =>  '商品名称必须填写',
        'category_id.require'    =>  '商品所属分类必须选择',
        'brand_id.require'    =>  '商品所属品牌必须选择',
        'ours_price.require'    =>  '商品价格必须填写',
        'status.require'    =>  '商品状态必须选择',
        'content.require'    =>  '商品介绍必须填写必须填写',
        'name.unique'    =>  '商品名称不能重复',
    ];
    protected $scene=[
    	'add'=>['name'=>'require|unique:commodity,name',
        'category_id','brand_id','ours_price','status','content'],
    	'edit'=>['name','category_id','brand_id','ours_price','status','content'],
    ];
}
