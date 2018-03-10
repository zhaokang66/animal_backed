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
        $arr_key = []; 
    	$res_temp = [];

        $length = mb_strlen($key,'utf8');
        $array = [];
        for($i=0;$i<$length;$i++) {
            $array[] = mb_substr($key, $i, 1, 'utf-8');
        }
        $fenci = jieba($key);
        foreach ($fenci as $val) {
            array_push($array, $val);
        }
        foreach ($array as $v) {

            $temp = Animals::where('color','like','%'.$v.'%')
                                ->orwhere('kind','like','%'.$v.'%')
                                ->orwhere('hairy','like','%'.$v.'%')
                                ->orwhere('pattern','like','%'.$v.'%')
                                ->orwhere('gender','like','%'.$v.'%')
                                ->orwhere('kind','like','%'.$v.'%')
                                ->orwhere('species','like','%'.$v.'%')
                                ->get();
                if (!empty($temp)) {
                    array_push($res_temp, $temp);
                }
        }
        $res = [];
        foreach ($res_temp as $value) {
            foreach ($value as $v) {
                array_push($res, $v);
            }
        }
        $arr_id = [];
         for($i=0;$i<count($res);$i++) {
            for($j=$i+1;$j<count($res);$j++) {
                if($i==(count($res)-1)){
                    break;    
                }
                if ($res[$i]['id'] == $res[$j]['id']) {
                    $arr_id[$res[$i]['id']] = $res[$i]['id'];
                }
            }
         }
        // $unique_arr = array_unique ( $res ); 
    // 获取重复数据的数组 
        // $result = array_diff_assoc ( $res, $unique_arr );

        // return $repeat_arr;
        $result = [];
        if (!empty($arr_id)) {
            foreach ($arr_id as $value) {
                $res_temp =Animals::where('id',$value)->first();
                array_push($result, $res_temp);
            }
        }
    	if (empty($result)) {
    		$result = $res;
    	}
        $output = [];                                                                        
    	foreach ($result as $v) {
            $img_url = explode('@', $v->img_url);
    		array_push($output, [
    			'id' => $v->id,
    			'number' => $v->number,
    			'img_url' => $img_url
    		]);
    	}
    	if (empty($output)) {
    		return [
    			'status'   => 0,
    			'data'     => array(),
    			'msg'      => '查询结果为空',
    			'condition'=> $array
    		];
    	}
    	
    		return [
    			'status'   => 200,
    			'data'     => $output,
    			'msg'      => 'success',
    			'condition'=> $array
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
        $res->img_url = explode('@', $res->img_url);
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
