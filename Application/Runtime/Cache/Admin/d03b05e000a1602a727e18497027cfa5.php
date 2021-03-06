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
		<?php if( in_array('delete',$key['auth_key']) ): ?>
		<button type="button"  class="btn btn-success btn-right" onclick="parent.adminObj.openNewTab('/admin/job/add','添加职位')">添加</button>
		<?php endif; ?>
	</div>	
</div>
<div class="content container-fluid">
	<div class="search-box">
		<form class="form-inline" id="search_form">
			<div class="row">				
				<div class="form-group">
					<label for="exampleInputName2">职位名</label>
					<input type="text" class="form-control" id="exampleInputName2" placeholder="请输入职位名" name="like:job_name">
				</div>
			</div>
		</form>
	</div>
	<div class="data-show">
		<table class="table table-bordered">
		   <thead>
		      	<tr class="active">
		         	<th>职位名</th>
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
	    <td><%= job_name %></td>
	    <td>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/job/edit/<%=id%>/browse','查看');" class="list-btn browse"></a>
	    	<?php if( in_array('edit',$key['auth_key']) ): ?>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/job/edit/<%=id%>/edit','编辑职位');" class="list-btn edit" ></a>
	    	<?php endif; ?>
	    	<?php if( in_array('delete',$key['auth_key']) ): ?>
	    	<a href="javascript:parent.adminObj.deleteData('/admin/job/deleteJob/<%=id%>');" class="list-btn del" ></a>
	    	<?php endif; ?>
	    	<?php if( in_array('edit',$key['auth_key']) ): ?>
	    	<a href="javascript:parent.adminObj.openNewTab('/admin/job/setJob/<%=id%>','设置权限');" class="list-text" >设置权限</a>
	    	<?php endif; ?>
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
	url:'/admin/job/pageData',
	tpl:'data_tpl'
});
const pageObj = new page($('.page_box'));
dataObj.setPage(pageObj);
dataObj.setSearch($("#search_form"),true);
dataObj.get_data();	
</script>	

</body>
</html>