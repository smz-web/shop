<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Relation extends Validate{
	protected $rule=[
        'category_id' =>  'require',
        'relation_name'  =>  'require|unique:category_relation',
        'relation_link'  =>  'require',
        'relation_target'  =>  'require',
        'relation_type'  =>  'require',
    ];
    protected $message=[
        'category_id.require'    =>  '所属商品分类必须选择',
        'relation_name.require'    =>  '关联名称必须填写',
        'relation_link.unique'    =>  '友情链接地址必须填写',
        'relation_target.require'    =>  '打开方式必须选择',
        'relation_type.require'    =>  '关联类型必须选择',
        'relation_name.unique'      =>  '关联名称不能重复',
    ];
    protected $scene=[
    	'add'=>['category_id','relation_name','relation_link','relation_target','relation_type'],
    	'edit'=>['category_id','relation_name'=>'require|unique:category_relation,relation_name^id','relation_link','relation_target'],
    ];
}
