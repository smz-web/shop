<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class MemberLevel extends Validate{
	protected $rule=[
        'level_name'    =>  'require|unique:member_level,id^level_name',
        'bottom_integral'    =>  'require',
        'top_integral'    =>  'require',
        'discount'    =>  'require',
    ];
    protected $message=[
        'level_name.require'    =>  '会员级别名称必须填写',
        'level_name.unique'    =>  '会员级别名称不能重复',
        'bottom_integral.require'    =>  '最低积分不能为空',
        'top_integral.require'    =>  '最高积分不能为空',
        'discount.require'    =>  '默认折扣不能为空',
    ];
    protected $scene=[
    	'add'=>
        ['level_name'=>'require|unique:member_level,
        level_name','bottom_integral','top_integral','discount'],
    	'edit'=>['level_name','bottom_integral','top_integral','discount'],
    ];
}
