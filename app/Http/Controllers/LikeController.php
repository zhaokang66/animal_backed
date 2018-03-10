<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;

class LikeController extends Controller
{
	public function store(Request $request)
	{
		$id = $request->get('id');
		$res = Animals::where('id',$id)->first();
		$res->like_num = $res->like_num+1;
		$res->save();
		$res = Animals::where('id',$id)->first();
		return '点赞成功';

	}
}