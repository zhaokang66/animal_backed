<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;

class AddController extends Controller
{
    public function index()
    {
    	return view('add');
    }
    public function store(Request $request)
    {
    	$file = $request->file('img');
    	$animal_add = $request->get('animal_add');//救助站编号
        //先拼接编号
        $id = Animals::orderBy('id','desc')->take(1)->get(['number']);
        $last_number = $id[0]['number'];
        $numberLastFour = substr($last_number, 3)+1;
        $number = $animal_add.$numberLastFour;
    	mkdir("upload/".$number,0777,true);
    	$filePath = [];
    	foreach ($file as $key => $value) {
    		if (!$value->isValid()) {
    			exit("上传图片出错，请重试!");
    		}
    		if (!empty($value)) {
    			$allow_extensions = ["png","jpg","gif"];
    			if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allow_extensions)) {
    				exit("格式不允许");
    			}
    			$destinationPath = 'upload/'.$number;
    			$extension  =$value->getClientOriginalExtension();
    			$fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
    			$value->move(public_path()."/".$destinationPath,$fileName);
    			$filePath[] = "https://api.zhaokang.info/".$destinationPath.'/'.$fileName;
    			
    		}
    	}
        // $station_num           //救助站编号
    	$img_url = implode('@', $filePath);
        // $animal_number = 
    	$animals = new Animals();
    	$animals->img_url = $img_url;
    	$animals->color = $request->get('color');
    	$animals->kind = $request->get('kind');
    	$animals->gender = $request->get('gender');
    	$animals->number = $number;
    	$animals->hairy = $request->get('hairy');
        $animals->pattern = $request->get('pattern');
        $animals->animal_add = $request->get('animal_add');
        $animals->species = $request->get('species');
    	$result = $animals->save();
    	if (!$result) {
    		return "添加失败";
    	}
    	return "<script>
			alert('添加成功');

			location.href = document.referrer; 

    	</script>";
    }
}

