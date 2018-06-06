<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Cate extends Validate{
	protected $rule=[
        'cate_name'    =>  'require|unique:cate,id^cate_name',
        'show_nav'    =>  'require',
        'pid'    =>  'require',
    ];
    protected $message=[
        'cate_name.require'    =>  '栏目名称必须填写',
        'cate_name.unique'    =>  '栏目名称不能重复',
        'show_nav.require'    =>  '状态必须选择',
        'pid.require'    =>  '上级栏目必须选择',
    ];
    protected $scene=[
    	'add'=>['cate_name'=>'require|unique:cate,cate_name','show_nav','pid'],
    	'edit'=>['cate_name','show_nav','pid'],
    ];
}
