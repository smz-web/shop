<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Nav extends Validate{
	protected $rule=[
        'nav_name' =>  'require|unique:nav',
        'nav_link'  =>  'require',
        'status'  =>  'require',
        'nav_pos'  =>  'require',
    ];
    protected $message=[
        'nav_name.require'    =>  '导航名称必须填写',
        'nav_link.require'    =>  '导航URL必须填写',
        'nav_status.require'    =>  '导航状态必须选择',
        'nav_pos.require'    =>  '导航位置必须选择',
    ];
    protected $scene=[
    	'add'=>['nav_link','nav_link','nav_name','nav_pos','status'],
    	'edit'=>['nav_link','nav_link','nav_name'=>'require|unique:nav,nav_name^id','nav_pos','status'],
    ];
}
