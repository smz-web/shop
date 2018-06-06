<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Conf extends Validate{
	protected $rule=[
        'title'    =>  'require|unique:conf',
        'name'    =>  'require|unique:conf|alphaDash',
        'area'    =>  'require',
        'mold'    =>  'require',
    ];
    protected $message=[
        'title.require'   =>  '配置名称必须填写',
        'name.require'    =>  '配置代号必须填写',
        'area.require'    =>  '配置位置必须选择',
        'mold.require'    =>  '配置类型必须选择',
        'title.unique'    =>  '配置名称不能重复',
        'name.unique'     =>  '配置代号不能重复',
        'name.alphaDash'     =>  '配置代号不能有中文或者特殊字符',
    ];
    protected $scene=[
    	'add'=>['title','name','area','mold'],
    	'edit'=>[
        'title'=>'require|unique:conf,id^title',
        'name'=>'require|alphaDash|unique:conf,id^name',
        'area','mold'],
    ];
}
