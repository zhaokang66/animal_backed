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

    	// $file = $_FILES['img'];
    	$number = $request->get('animal_add');
    	// var_dump($file);
    	// die();
    	//图片上传
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
    			$filePath[] = $destinationPath.'/'.$fileName;
    			
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
    	$animals->number = rand(1000,9999); 
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

