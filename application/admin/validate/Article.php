<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Article extends Validate{
	protected $rule=[
        'title'    =>  'require|unique:article,id^title',
        'status'    =>  'require',
        'cate_id'    =>  'require',
    ];
    protected $message=[
        'title.require'    =>  '标题必须填写',
        'title.unique'    =>  '标题不能重复',
        'status.require'    =>  '状态必须选择',
        'cate_id.require'    =>  '所属栏目必须选择',
    ];
    protected $scene=[
    	'add'=>['title'=>'require','status','cate_id'],
    	'edit'=>['title','status','cate_id'],
    ];
}
