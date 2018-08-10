<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\phpStudy\WWW\Property\public/../application/home/view/default/notice\notice.html";i:1533870349;s:81:"D:\phpStudy\WWW\Property\public/../application/home/view/default/public\base.html";i:1533810140;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/homestatic/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/homestatic/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    

    <div class="container-fluid">
        <div id="test">

        </div>

        <div id="more">
            <a class="page"  href="javascript:;">获取更多</a>
        </div>
    </div>

    

    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('home/Index/index'); ?>" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('user/login/index'); ?>" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/homestatic/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/homestatic/bootstrap/js/bootstrap.min.js"></script>

    <script>

function getMore(url,p) {

    $.get(url,'p='+p,function(e){
        var data=JSON.parse(e);
        var str='';
        if(data.notice.length!=0){
            $.each(data.notice,function(index){
                notice=data.notice[index];

                var img='';
                if(notice.url){
                    img=notice.url.path;
                }
                str+='<div class="row noticeList">'+
                    '<a href="/home/notice/detail?id='+notice.id+'">'+
                    '<div class="col-xs-2">'
                    +'<img class="noticeImg" src="'+img+'" />'
                    +'</div>'
                    +'<div class="col-xs-10">'
                    +'<p class="title">'+notice['title']+'</p>'
                    +'<p class="intro">'+notice.description+'</p>'
                    +'<p class="info">浏览: '+notice.view+' <span class="pull-right">'+notice.create_time+'</span> </p>'
                    +'</div>'
                    +'</a>'
                    +'</div>'
            });
            $('.page').attr('p',data.p);
            $("#test").append(str);
        }else{
            $("#more").text('没有更多了')
        }



    });
}

        var url='/home/notice/more';

        var  p=1;
        getMore(url,p);


        $("#more").on('click',".page",function(){

            var url='/home/notice/more';
            var p=$(this).attr('p');
            var str='';
            getMore(url,p);
        });


    </script>




</body>
</html>
