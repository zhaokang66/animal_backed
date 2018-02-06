<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
    	$key = $request->get('key');
    	if (empty(trim($key))) {
    		return [
    			'status'  =>  '-1',
    			'data'    =>  array(),
    			'msg'     =>  '参数不能为空' 
    		];
    	}
    	$arr_key = jieba($key);
    	$count = count($arr_key);
    	$res = [];
    	$res_temp = [];
    
    
    	for($i=0;$i<$count;$i++) {
    		$temp = Animals::where('color','like','%'.$arr_key[$i].'%')
    						->orwhere('kind','like','%'.$arr_key[$i].'%')
    						->get();
    		array_push($res_temp, $temp);
    	}
    	for($i=0;$i<count($res_temp);$i++) {
			for($j=0;$j<count($res_temp[$i]);$j++) {
				array_push($res, $res_temp[$i][$j]);
			}	    			
    	}
    	$unique_arr = array_unique ($res); 
    	$result =  array_diff_assoc ( $res, $unique_arr );
    	if (empty($result)) {
    		$result = $res;
    	}
    	$output = [];
    	foreach ($result as $v) {
    		array_push($output, [
    			'id' => $v->id,
    			'number' => $v->number,
    			'img_url' => $v->img_url
    		]);
    	}
    	if (empty($output)) {
    		return [
    			'status'   => 0,
    			'data'     => array(),
    			'msg'      => '查询结果为空',
    			'condition'=> $arr_key
    		];
    	}
    	
    		return [
    			'status'   => 200,
    			'data'     => $output,
    			'msg'      => 'success',
    			'condition'=> $arr_key
    		];
    }


    public function animalinfo(Request $request)
    {		
    	$id = $request->get('id');
    	if (empty(trim($id))) {
    		return [
    			'status'  =>  '-1',
    			'data'    =>  array(),
    			'msg'     =>  'id不能为空' 
    		];
    	}
    	$res = Animals::find($id);
    	if (empty($res)) {
    		return [
    			'status' => 0,
    			'data'   => array(),
    			'msg'    => '信息不存在'
    		];
    	}
    	return [
    		'status'  => 200,
    		'data'    => $res,
    		'msg'     => 'success'
    	];
    }
}
