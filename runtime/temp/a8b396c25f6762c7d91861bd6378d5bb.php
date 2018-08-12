<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\WWW\Property\public/../application/admin/view/default/house\add.html";i:1534039009;s:82:"D:\phpStudy\WWW\Property\public/../application/admin/view/default/public\base.html";i:1496373782;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?>|TwoThink管理平台</title>
    <link href="__ROOT__/public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/<?php echo \think\Config::get('color_style'); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__PUBLIC__/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__['main']) || $__MENU__['main'] instanceof \think\Collection || $__MENU__['main'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['main'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                <li class="<?php echo (isset($menu['class']) && ($menu['class'] !== '')?$menu['class']:''); ?>"><a href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username'); ?>"><?php echo session('user_auth.username'); ?></em></li>
                <li><a  onclick="go_home();">前台首页</a></li>
                <li><a href="<?php echo url('User/updatePassword'); ?>">修改密码</a></li>
                <li><a href="<?php echo url('User/updateNickname'); ?>">修改昵称</a></li>
                <li><a href="<?php echo url('Admin/delcache'); ?>">更新缓存</a></li>
                <li><a href="<?php echo url('Publics/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!(empty($_extra_menu) || (($_extra_menu instanceof \think\Collection || $_extra_menu instanceof \think\Paginator ) && $_extra_menu->isEmpty()))): ?>
                    
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; if(is_array($__MENU__['child']) || $__MENU__['child'] instanceof \think\Collection || $__MENU__['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?>
                    <!-- 子导航 -->
                    <?php if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(!(empty($key) || (($key instanceof \think\Collection || $key instanceof \think\Paginator ) && $key->isEmpty()))): ?><h3><i class="icon icon-unfold"></i><?php echo $key; ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a class="item" href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a>
                                </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    <?php endif; ?>
                    <!-- /子导航 -->
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!(empty($_show_nav) || (($_show_nav instanceof \think\Collection || $_show_nav instanceof \think\Paginator ) && $_show_nav->isEmpty()))): ?>
            <div class="breadcrumb">
                <span>您的位置:</span>
                <assign name="i" value="1" />
                <?php if(is_array($_nav) || $_nav instanceof \think\Collection || $_nav instanceof \think\Paginator): if( count($_nav)==0 ) : echo "" ;else: foreach($_nav as $k=>$v): if($i == count($_nav)): ?>
                    <span><?php echo $v; ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo $k; ?>"><?php echo $v; ?></a>&gt;</span>
                    <?php endif; ?>
                    <assign name="i" value="$i+1" />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; ?>
            <!-- nav -->
            

            
<script type="text/javascript" src="/homestatic/jquery.uploadify.min.js"></script>
	<div class="main-title">
		<h2>
			添加房屋信息
		</h2>
	</div>
	<form action="<?php echo url('House/add'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

		<div class="form-item">
			<div class="controls">
				<select name="type" id="">
					<option value="0">出租</option>
					<option value="1">出售</option>
				</select>
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">标题<span class="check-tips"></span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="title" value="">
			</div>
		</div>
		<div class="form-item">
			<label class="item-label">价格<span class="check-tips"></span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="price" value="">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">电话<span class="check-tips"></span></label>
			<div class="controls">
				<input type="text" class="text input-large" name="tel" value="">
			</div>
		</div>

		<div class="form-item">
			<label class="item-label">是否显示<span class="check-tips"></span></label>
			<div class="controls">
				<label><input type="radio"  name="status" value="0">不显示</label>
				<label><input type="radio"  name="status" value="1">显示</label>
			</div>
		</div>


		<div class="controls">
			<div class="controls">
				<div id="upload_picture_cover_id" class="uploadify" style="height: 30px; width: 120px;"><object id="SWFUpload_1" type="application/x-shockwave-flash" data="/static/static/uploadify/uploadify.swf?preventswfcaching=1533992945062" width="120" height="30" class="swfupload" style="position: absolute; z-index: 1;"><param name="wmode" value="transparent"><param name="movie" value="/static/static/uploadify/uploadify.swf?preventswfcaching=1533992945062"><param name="quality" value="high"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="flashvars" value="movieName=SWFUpload_0&amp;uploadURL=%2Fadmin%2Ffile%2Fuploadpicture%2Fsession_id%2Fhq3d7t2ec8s2gp4nooi43dprn1.html&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=30&amp;params=&amp;filePostName=download&amp;fileTypes=*.jpg%3B%20*.png%3B%20*.gif%3B&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=0&amp;fileUploadLimit=0&amp;fileQueueLimit=999&amp;debugEnabled=false&amp;buttonImageURL=%2Fadmin%2Farticle%2Fadd%2Fcate_id%2F49%2Fpid%2F0%2Fmodel_id%2F&amp;buttonWidth=120&amp;buttonHeight=30&amp;buttonText=&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=0&amp;buttonTextStyle=color%3A%20%23000000%3B%20font-size%3A%2016pt%3B&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2"></object><div id="upload_picture_cover_id-button" class="uploadify-button " style="height: 30px; line-height: 30px; width: 120px;"><span class="uploadify-button-text">上传图片</span></div></div><div id="upload_picture_cover_id-queue" class="uploadify-queue"></div>
				<input type="hidden" name="cover_id" id="cover_id_cover_id">
				<span>建议大小：200*200像素</span>
				<div class="upload-img-box">
				</div>
			</div>
			<!--<script src="/homestatic/jquery-1.11.2.min.js"></script>-->
			<script type="text/javascript">
                //上传图片
				/* 初始化上传插件 */
                $("#upload_picture_cover_id").uploadify({
                    "height"          : 30,
                    "swf"             : "/static/static/uploadify/uploadify.swf",
                    "fileObjName"     : "download",
                    "buttonText"      : "上传图片",
                    "uploader"        : "/admin/file/uploadpicture/session_id/hq3d7t2ec8s2gp4nooi43dprn1.html",
                    "width"           : 120,
                    'removeTimeout'	  : 1,
                    'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                    "onUploadSuccess" : uploadPicturecover_id,
                    'onFallback' : function() {
                        alert('未检测到兼容版本的Flash.');
                    }
                });
                function uploadPicturecover_id(file, data){
                    var data = $.parseJSON(data);
                    var src = '';
                    if(data.status){
                        $("#cover_id_cover_id").val(data.id);
                        src = data.url || '' + data.path
                        $("#cover_id_cover_id").parent().find('.upload-img-box').html(
                            '<div class="upload-pre-item"><img src="' + src + '"/></div>'
                        );
                    } else {
                        updateAlert(data.info);
                        setTimeout(function(){
                            $('#top-alert').find('button').click();
                            $(that).removeClass('disabled').prop('disabled',false);
                        },1500);
                    }
                }
			</script>
		</div>




		<div class="form-item">
			<label class="item-label">出租/售开始时间<span class="check-tips"></span></label>
			<div class="controls">
				<input type="datetime-local" class="text input-large" name="rental_time" value="">
			</div>
		</div>


		<div class="form-item cf">
			<label class="item-label">截至时间<span class="check-tips"></span></label>
			<div class="controls">
				<input type="datetime-local" name="end_time" class="text time" value="" placeholder="请选择时间">
			</div>
		</div>

		<div class="form-item">
		<label class="item-label">简介<span class="check-tips"></span></label>
		<div class="controls">
			<textarea name="description"  cols="55" rows="8"></textarea>
		</div>
	</div>

		<div class="form-item cf">
			<label class="item-label">内容</label>
			<div class="controls">
				<label class="textarea">
					<textarea name="content"></textarea>

					<script type="text/javascript" charset="utf-8" src="/static/static/ueditor/ueditor.config.js"></script>
					<script type="text/javascript" charset="utf-8" src="/static/static/ueditor/ueditor.all.js"></script>
					<script type="text/javascript" charset="utf-8" src="/static/static/ueditor/lang/zh-cn/zh-cn.js"></script>
					<script type="text/javascript">
                        $('textarea[name="content"]').attr('id', 'editor_id_content');
                        window.UEDITOR_HOME_URL = "/static/ueditor";
                        window.UEDITOR_CONFIG.initialFrameHeight = parseInt('500px');
                        window.UEDITOR_CONFIG.scaleEnabled = true;
                        window.UEDITOR_CONFIG.imageUrl = '/home/addons/editorforadmin/upload/ue_upimg.html';
                        window.UEDITOR_CONFIG.imagePath = '';
                        window.UEDITOR_CONFIG.imageFieldName = 'imgFile';
                        UE.getEditor('editor_id_content');
					</script>
				</label>
			</div>
		</div>

		<div class="form-item">
			<button class="btn submit-btn ajax-posts" id="submit" type="submit" target-form="form-horizontal">确 定</button>
			<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
		</div>
	</form>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.twothink.cn" target="_blank">TwoThink</a>管理平台</div>
                <div class="fr">V<?php echo TWOTHINK_VERSION; ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "__ROOT__", //当前网站地址
            "APP"    : "__APP__", //当前项目地址
            "PUBLIC" : "__PUBLIC__", //项目公共目录地址
            "DEEP"   : "<?php echo config('pathinfo_depr'); ?>", //PATHINFO分割符
            "MODEL"  : ["3", "<?php echo config('url_convert'); ?>", "<?php echo config('url_html_suffix'); ?>"],//config('URL_MODEL')
            "VAR"    : ["<?php echo config('var_module'); ?>", "<?php echo config('var_controller'); ?>", "<?php echo config('var_action'); ?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="__PUBLIC__/static/think.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
        function go_home() {
          window.open("<?php echo url('/'); ?>");
        }
    </script>
    

<script type="text/javascript" charset="utf-8">
	//导航高亮
//	highlight_subnav('<?php echo url('index'); ?>');
</script>

</body>
</html>
