<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
	<style type="text/css">
		.form-horizontal{
		    background: #fff;
		    padding-bottom: 40px;
		    border-radius: 15px;
		    text-align: center;
		}
		.form-horizontal .heading{
		    display: block;
		    font-size: 35px;
		    font-weight: 700;
		    padding: 35px 0;
		    border-bottom: 1px solid #f0f0f0;
		    margin-bottom: 30px;
		}
		.form-horizontal .form-group{
		    padding: 0 40px;
		    margin: 0 0 25px 0;
		    position: relative;
		}
		.form-horizontal .form-control{
		    background: #f0f0f0;
		    border: none;
		    border-radius: 20px;
		    box-shadow: none;
		    padding: 0 20px 0 45px;
		    height: 40px;
		    transition: all 0.3s ease 0s;
		}
		.form-horizontal .form-control:focus{
		    background: #e0e0e0;
		    box-shadow: none;
		    outline: 0 none;
		}
		.form-horizontal .form-group i{
		    position: absolute;
		    top: 12px;
		    left: 60px;
		    font-size: 17px;
		    color: #c8c8c8;
		    transition : all 0.5s ease 0s;
		}
		.form-horizontal .form-control:focus + i{
		    color: #00b4ef;
		}
		.form-horizontal .text{
		    float: left;
		    margin-left: 7px;
		    line-height: 20px;
		    padding-top: 5px;
		    text-transform: capitalize;
		}
		.form-horizontal .btn{
		    font-size: 14px;
		    color: #fff;
		    background: #00b4ef;
		    border-radius: 30px;
		    padding: 10px 25px;
		    border: none;
		    text-transform: capitalize;
		    transition: all 0.5s ease 0s;
		}
		@media only screen and (max-width: 479px){
		    .form-horizontal .form-group{
		        padding: 0 25px;
		    }
		    .form-horizontal .form-group i{
		        left: 45px;
		    }
		    .form-horizontal .btn{
		        padding: 10px 20px;
		    }
		}
		.gender{
			position: relative;
			display: block;
			margin-left: -35%;
		}
		.file-box{
			margin-top: 15px;
		}
	</style>
</head>
<body>
	<div class="htmleaf-container">
		<div class="demo form-bg" style="padding: 20px 0;">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-offset-3 col-md-6">
		                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('/insert')}}" onsubmit="return validata();">
		                        <span class="heading">添加萌宠信息</span>
								{{ csrf_field() }}

								<div class="form-group help gender">
								    <select class="form-control" name="kind" id="kind">
								      <option>请选择萌宠的种类</option>
								      <option value="猫">猫</option>
								      <option value="狗">狗</option>
								    </select>
								 </div>
								

								<div class="form-group">
		                            <input type="text" class="form-control" id="species" placeholder="请输入萌宠具体品种（例如哈士奇，暹罗猫）" name="species" >

		                        </div>

		                 
	
		                        <div class="form-group help">
		                            <input type="text" class="form-control"  placeholder="请输入萌宠毛色" name="color" id="color">
		                        </div>
		                        
		                        <div class="form-group help">
		                            <input type="text" class="form-control"  placeholder="请输入萌宠毛质" name="hairy" id="hairy">
		                        </div>
		                        
		                        <div class="form-group help">
		                            <input type="text" class="form-control"  placeholder="请输入萌宠花纹" name="pattern" id="pattern">
		                        </div>
								

								<div class="form-group help">
									<select name="animal_add" id="animal_add" class="form-control">
										<option >请选择救助站</option>
										<option value="101">烟台xxx救助站</option>
									</select>
		                        </div>

								<div class="form-group help gender">
								    <select class="form-control" name="gender" id="gender">
								    	<option >请选择萌宠性别</option>
								      	<option value="公">公</option>
								      	<option value="母">母</option>
								    </select>
								 </div>
		                        <div class="form-group">
		                        	<label for="name_url" class="gender">请上传萌宠图片</label>
		                        	<input type="file" name="img[]" multiple class="file-box" id="img">
		                        </div>
						
		                        <div class="form-group">
		                            <button type="submit" class="btn btn-default">确认添加</button>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
	</div>
	<script>
		function validata() {
			var kind = get('kind');
			var color = get('color');
			var hairy = get('hairy');
			var number = get('number');
			var pattern = get('pattern');
			var animal_add  = get('animal_add');
			var gender = get('gender');
			var img = get('img');
			if (trim(kind.value) == "请选择萌宠的种类") {
				alert("萌宠种类不能为空");
				kind.focus();
				return false;
			}
			if (trim(gender.value)=='请选择萌宠性别') {
				alert("萌宠性别不能为空");
				return false;
			}
			if (trim(color.value)==null || trim(color.value)=='') {
				alert("萌宠颜色不能为空");
				color.focus();
				return false;
			}
			if (trim(number.value)==null || trim(number.value)=='') {
				alert("萌宠编号不能为空");
				number.focus();
				return false;
			}
			if (trim(hairy.value)==null || trim(hairy.value)=='') {
				alert("萌宠毛质不能为空");
				hairy.focus();
				return false;
			}
			if (trim(pattern.value)==null || trim(pattern.value)=='') {
				alert("萌宠花纹不能为空");
				pattern.focus();
				return false;
			}
			if (trim(img.value)==null || trim(img.value)=='') {
				alert("萌宠图片不能为空");
				return false;
			}
			if (trim(animal_add.value)==null || trim(animal_add.value)=='') {
				alert("救助站地址不能为空");
				return false;
			}
			return true;

		}
		function get(id) {
			return document.getElementById(id);
		}
		 function trim(str){ //删除左右两端的空格
	     　　     return str.replace(/(^\s*)|(\s*$)/g, "");
	    }
	</script>
</body>
</html>