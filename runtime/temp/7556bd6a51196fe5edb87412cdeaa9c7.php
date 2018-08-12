<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\phpStudy\WWW\Property\public/../application/home/view/default/index\shenghuo.html";i:1534069883;s:81:"D:\phpStudy\WWW\Property\public/../application/home/view/default/public\base.html";i:1534054270;}*/ ?>
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
    <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sheng): $mod = ($i % 2 );++$i;?>
    <div class="row noticeList">
        <a href="/home/article/detail?id=<?php echo $sheng['id']; ?>">
            <div class="col-xs-1">
                <img class="noticeImg" src="" />
            </div>
            <div class="col-xs-10">
                <p class="title"><?php echo $sheng['title']; ?></p>
                <p class="intro"><?php echo $sheng['description']; ?></p>
                <p class="intro"><?php echo $sheng['create_time']; ?></p>
                <p class="info">浏览<span class="pull-right"></span><?php echo $sheng['view']; ?></p>
            </div>
        </a>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>



    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('home/Index/index'); ?>" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('home/Index/service'); ?>" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('home/Index/find'); ?>" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">

                <p class="navbar-text"><a href="<?php echo url('home/Index/user'); ?>" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/homestatic/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/homestatic/bootstrap/js/bootstrap.min.js"></script>



</body>
</html>
