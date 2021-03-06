<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\Property\public/../application/user/view/default/login\index.html";i:1533795119;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>登录</title>

    <link href="__STATIC__/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="__STATIC__/bootstrap/css/docs.css" rel="stylesheet">


    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">

    <div class="container-fluid">
        <h3>登录</h3>
        <form class="login-form" action="" method="post">
            <div class="form-group">

                <div class="controls">
                    <input type="text"  style="width: 95%" id="inputEmail" class="span3" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
                </div>
                </div>

            <div class="form-group">

                <div class="controls">
                    <input type="password"   style="width: 95%" id="inputPassword"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
                </div>
            </div>
            <div class="form-group">

                <div class="controls">
                    <input type="text"  style="width: 95%"  id="inputPassword" class="span3" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls verifyimg">
                    <div><img width="100%" src="<?php echo captcha_src(); ?>" alt="captcha" /></div>
                </div>
                <div class="controls Validform_checktip text-warning"></div>
            <div class="form-group" style="margin-top: 15px;">
                <label class="checkbox">
                    <input type="checkbox"> 自动登陆
                </label>
                <button class="btn btn-primary onlineBtn btn-block">确认提交</button>
                <div style="margin-top: 15px;">还没账号?<a href="<?php echo url('login/register'); ?>">立即注册</a></div>
            </div>
           </div>
        </form>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });


    $("form").submit(function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.code){
                window.location.href = data.url;
            } else {
                self.find(".Validform_checktip").text(data.msg);
                //刷新验证码
                $(".verifyimg img").click();
            }
        }
    });



    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>
</body>
</html>