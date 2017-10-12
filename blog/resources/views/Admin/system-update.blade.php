<!DOCTYPE HTML>
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
<link rel="stylesheet" type="text/css" href="{{asset('/Admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/bootstrap-3.3.7/js/bootstrap.min.js')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/Admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/Admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/Admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('/Admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v2.4</title>
<meta name="keywords" content="H-ui.admin 3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin 3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    @if (session('msg'))
        <div id="time" style="width:340px;height:30px;background-color:green">
            {{ session('msg') }}
        </div>
    @endif

    @if (session('errorTip'))
        <div id="tim" style="width:340px;height:30px;background-color:red">
            {{ session('errorTip') }}
        </div>
    @endif
    
    <form class="form form-horizontal" id="form-admin-add" action="{{url('admin/update')}}" method="post" enctype="multipart/form-data">


    {{csrf_field()}}

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>网站名字</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="hidden" value="{{$one->id}}" name="id">
            <input type="text" class="input-text" value="{{$one->name}}" placeholder="" id="adminName" name="name">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>源Logo</label>
        <div class="formControls col-xs-8 col-sm-9">
            <img src="{{asset($one->logo)}}" alt="">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传新Logo</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="file" class="input-text" value="" placeholder="" id="adminName" name="logo">
        </div>
    </div>
    
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        </div>
    </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{asset('/Admin/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/Admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('/Admin/static/h-ui/js/H-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/Admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('/Admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script> 
<script type="text/javascript" src="{{asset('/Admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script> 
<script type="text/javascript" src="{{asset('/Admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script> 
<script type="text/javascript">

setTimeout(function () {

    $('#time').removeClass().html('').css('display', 'none');
},2000);

setTimeout(function () {

    $('#tim').removeClass().html('').css('display', 'none');
},2000);
// $(function(){
//  $('.skin-minimal input').iCheck({
//      checkboxClass: 'icheckbox-blue',
//      radioClass: 'iradio-blue',
//      increaseArea: '20%'
//  });
    
//  $("#form-admin-add").validate({
//      rules:{
//          adminName:{
//              required:true,
//              minlength:4,
//              maxlength:16
//          },
//          password:{
//              required:true,
//          },
//          password2:{
//              required:true,
//              equalTo: "#password"
//          },
//          sex:{
//              required:true,
//          },
//          phone:{
//              required:true,
//              isPhone:true,
//          },
//          email:{
//              required:true,
//              email:true,
//          },
//          adminRole:{
//              required:true,
//          },
//      },
//      onkeyup:false,
//      focusCleanup:true,
//      success:"valid",
//      submitHandler:function(form){
//          $(form).ajaxSubmit({
//              type: 'post',
//              url: "xxxxxxx" ,
//              success: function(data){
//                  layer.msg('添加成功!',{icon:1,time:1000});
//              },
//                 error: function(XmlHttpRequest, textStatus, errorThrown){
//                  layer.msg('error!',{icon:1,time:1000});
//              }
//          });
//          var index = parent.layer.getFrameIndex(window.name);
//          parent.$('.btn-refresh').click();
//          parent.layer.close(index);
//      }
//  });
// });
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>