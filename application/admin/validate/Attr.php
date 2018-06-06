<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Attr extends Validate{
	protected $rule=[
        'attr_name'    =>  'require|unique:attr,id^attr_name',
        'attr_type'    =>  'require',
        'pid'    =>  'require',
    ];
    protected $message=[
        'attr_name.require'    =>  '状态名称必须填写',
        'attr_name.unique'    =>  '状态名称不能重复',
        'attr_type.require'    =>  '状态必须选择',
        'pid.require'        =>  '所属类型必须选择',
    ];
    protected $scene=[
    	'add'=>['attr_name'=>'require|unique:attr,attr_name','attr_type','pid'],
    	'edit'=>['attr_name','attr_type','pid'],
    ];
}
