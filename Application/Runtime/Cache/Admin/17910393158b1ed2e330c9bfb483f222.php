<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<title></title>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="/Public/css/list.css">
	
</head>
<body>

<div class="head container-fluid">
	<div class="row">
		<span class="title"><?php echo ($title); ?></span>			
		<button type="button"  class="btn btn-success btn-right" onclick="parent.adminObj.openNewTab('/admin/func/add','添加功能')">添加</button>
	</div>	
</div>
<div class="content container-fluid">
	<div class="search-box">
		<form class="form-inline" id="search_form">
			<div class="row">				
				<div class="form-group">
					<label for="exampleInputName2">键值</label>
					<input type="text" class="form-control" id="exampleInputName2" placeholder="请输入键值" name="like:key">
				</div>
			</div>
		</form>
	</div>
	<div class="data-show">
		<table class="table table-bordered">
		   <thead>
		      	<tr class="active">
		         	<th>键值</th>
		         	<th>键名</th>
		        	<th>操作</th>
		      	</tr>
		   </thead>
		   <tbody id="data_box">
		      	
		   </tbody>
		</table>
	</div>
	<div class="page_box container-fluid"></div>
	<script type="text/html" id="data_tpl">
	<tr>
	    <td><%= key %></td>
	    <td><%= func_name %></td>
	    <td>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/func/edit/<%=key%>/browse','查看');" class="list-btn browse"></a>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/func/edit/<%=key%>/edit','编辑功能');" class="list-btn edit" ></a>
	    	<a href="javascript:parent.adminObj.deleteData('/admin/func/deleteFunc/<%=key%>');" class="list-btn del" ></a>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/func/setFunc/<%=key%>','编辑权限');" class="list-text" >编辑权限</a>
	    </td>
	</tr>	
	</script>	
</div>

<script type="text/javascript" src="/Public/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="/Public/js/template.min.js"></script>
<script type="text/javascript" src="/Public/js/list.js"></script>
<script type="text/javascript" src="/Public/js/page.js"></script> 

<script type="text/javascript">
var dataObj = new list({
	box:$('#data_box'),
	url:'/admin/func/pageData',
	tpl:'data_tpl'
});
const pageObj = new page($('.page_box'));
dataObj.setPage(pageObj);
dataObj.setSearch($("#search_form"),true);
dataObj.get_data();	
</script>	

</body>
</html>