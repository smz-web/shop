<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Link extends Validate{
	protected $rule=[
        'title' =>  'require',
        'link'  =>  'require',
        'name'  =>  'require',
        'status'  =>  'require',
    ];
    protected $message=[
        'title.require'    =>  '友情链接标题必须填写',
        'name.require'    =>  '友情链接名称必须填写',
        'name.unique'    =>  '友情链接名称不能重复',
        'status.require'    =>  '状态必须选择',
        'link.require'    =>  '链接地址必须选择',
    ];
    protected $scene=[
    	'add'=>['title','link','name'=>'require|unique:link,name','status'],
    	'edit'=>['title','link','name'=>'require|unique:link,name^id','status'],
    ];
}
