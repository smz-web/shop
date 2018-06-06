<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function get_Ueditor($name,$value='',$width='800',$height='250'){	//百度编辑器
	//名称，默认值，宽度，高度
	$str=<<<HTMLL
	<textarea name="$name" id="$name">$value</textarea>
<script type="text/javascript">
UE.getEditor('$name',{initialFrameWidth:$width,initialFrameHeight:$height,});
</script>
HTMLL;
return $str;
}
function delete_img($SaveName){	//删除图片
    	if(file_exists($SaveName)){
				@unlink($SaveName);
		}
}
function classify($info,$pid=0,$level=0){	//无限级分类
	static $arr=array();
	foreach($info as $k=>$v){
		if($v['pid']==$pid){
			$v['level']=$level;
			$arr[]=$v;
			classify($info,$v['id'],$level+1);
		}
	}
	return $arr;
}
function family($arr,$id){ //删除栏目下文章
	static $res=array();
	$res[]=$id;
	foreach($arr as $k=>$v){
		if($v['pid']==$id){
			family($arr,$v['id']);
		}
	}
	return $res;
}
