<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/Public/css/edit.css">
    
</head>
<body>

<div class="detail">
    <form id="edit_form" data-action="/admin/func/save" >
        <input type="hidden" value="<?php echo ($action); ?>" name="action">
        <input type="hidden" value="" name="id">
    	<div class="detail-row">
    		<div class="row-label">
    			<span class="must">键值:</span>
    		</div>
    		<div class="row-input">
    			<input type="text" data-allow="login_name" name="key" placeholder="请输入键值" maxlength="12">
    		</div>
    	</div>
        <div class="detail-row">
            <div class="row-label">功能名称:</div>
            <div class="row-input">
                <input type="text" name="func_name" placeholder="请输入键名" maxlength="14">
            </div>
        </div>
    </form>
</div>


<div class="btn_box">
    <button type="button" class="btn btn-success" data-btn="submit">保存</button>
</div>

<script src="/Public/js/jquery-3.0.0.min.js" type="text/javascript"></script>
<script src="/Public/js/input_allow.js" type="text/javascript"></script>
<script src="/Public/js/edit.js" type="text/javascript"></script>

<script type="text/javascript">
const editObj = new edit();
editObj.saveurl='/admin/func/edit/{id}/edit';
<?php if($action != 'add'): ?>editObj.setForm($("#edit_form"),<?=json_encode($data)?>);<?php endif; ?>
</script>   

</body>
</html>