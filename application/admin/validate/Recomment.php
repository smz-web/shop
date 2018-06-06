<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Recomment extends Validate{
	protected $rule=[
        'rec_name' =>  'require|unique:recomment',
        'rec_type'  =>  'require',
    ];
    protected $message=[
        'rec_name.require'    =>  '推荐位名称必须填写',
        'rec_type.require'    =>  '推荐位类型必须选择',
        'rec_name.unique'    =>  '推荐位名称不能重复',
    ];
    protected $scene=[
    	'add'=>['rec_name','rec_type'],
    	'edit'=>['rec_name'=>'require|unique:recomment,rec_name^id','rec_type',''],
    ];
}
