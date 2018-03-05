<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta name="renderer" content="webkit">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<title>后台主页</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/index.css">
	<link rel="stylesheet" type="text/css" href="/Public/bootstrap/css/bootstrap.min.css">
</head>
<body>
<header class="container-fluid">
	<a class="brand" href="/admin">
		<img src="/Public/images/logo1.png" alt="logo"/>
	</a>	       
	<ul class="nav pull-right">
		<li class="dropdown user">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" id="userinfo">
			<?php if($header_img != ''): ?><img class="head_img" src="<?php echo ($header_img); ?>" />
			<?php else: ?> 
				<img class="head_img" src="/Public/images/default.png" /><?php endif; ?>
			<span class="username"><?php echo ($true_name); ?></span>
			<i class="icon-angle-down"></i>
			</a>
			<ul class="dropdown-menu" style="min-width:120px;">
				<li><a href="javascript:adminObj.openNewTab('/admin/index/pwd','修改密码');"><i class="icon-user"></i>修改密码</a></li>
				<li><a href="<?php echo U('admin/index/loginout');?>"><i class="icon-key"></i>退出登录</a></li>
			</ul>
		</li>
	</ul>	
</header>
<main>
	<div class="left">
		<?=$menu?>
	</div>
	<div class="content">
		<iframe src="<?php echo U('admin/index/welcome');?>" id="list" name="list"></iframe>
	</div>
</main>
<script src="/Public/js/jquery-3.0.0.min.js" type="text/javascript"></script>  
<script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Public/js/jq_notice.js" type="text/javascript"></script>
<script src="/Public/js/admin.js" type="text/javascript"></script>
</body>
</html>