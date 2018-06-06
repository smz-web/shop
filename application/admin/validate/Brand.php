<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Brand extends Validate{
	protected $rule=[
        'brand_name'    =>  'require|unique:Brand,id^brand_name',
        'brand_status'    =>  'require',
    ];
    protected $message=[
        'brand_name.require'    =>  '品牌名称必须填写',
        'brand_name.unique'    =>  '品牌名称不能重复',
        'brand_status.require'    =>  '状态必须选择',
    ];
    protected $scene=[
    	'add'=>['brand_name'=>'require|unique:brand,brand_name','brand_status'],
    	'edit'=>['brand_name','brand_status'],
    ];
}
