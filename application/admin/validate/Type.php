<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Type extends Validate{
	protected $rule=[
        'type_name'    =>  'require|unique:type,id^type_name',
    ];
    protected $message=[
        'type_name.require'    =>  '类型名称必须填写',
        'type_name.unique'    =>  '类型名称不能重复',
    ];
    protected $scene=[
    	'add'=>['type_name'=>'require|unique:type,type_name'],
    	'edit'=>['type_name'],
    ];
}
