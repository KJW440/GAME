﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('Admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('Admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('Admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('Admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('Admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<title>图片展示</title>
<link href="{{asset('Admin/lib/lightbox2/2.8.1/css/lightbox.css')}}" rel="stylesheet" type="text/css" >
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片展示 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="{{url('admin/coverplan/create')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe6df;</i> 添加图片</a>  </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="portfolio-content">
		<ul class="cl portfolio-area">
			@foreach($coverImg as $v)
			<li class="item">
				<div class="portfoliobox">
					<div class="picbox"><a href="{{asset(json_decode($v->price)[1])}}" data-lightbox="gallery"><img src="{{asset(json_decode($v->price)[0])}}"></a></div>
					<div style="margin-top:10px;">
						<center>
							<a onClick="product_stop(this,'{{$v->id}}')"  href="javascript:;">删除</a>
						</center>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('Admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('Admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('Admin/lib/lightbox2/2.8.1/js/lightbox.min.js')}}"></script>
<script type="text/javascript">
$(function(){
	$(".portfolio-area li").Huihover();
});
function product_stop(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: "{{url('/admin/cover/del')}}"+'/'+id,
			dataType: 'json',
			success: function(data){
				$(obj).parent().parent().parent().parent().remove();
				layer.msg('已删除!',{icon: 5,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
</script>
</body>
</html>