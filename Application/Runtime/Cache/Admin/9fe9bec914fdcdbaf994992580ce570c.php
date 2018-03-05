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
    <form id="edit_form" data-action="/admin/staff/save" >
        <input type="hidden" value="<?php echo ($action); ?>" name="action">
        <input type="hidden" value="" name="id">
    	<div class="detail-row">
    		<div class="row-label">
    			<span class="must">登录名:</span>
    		</div>
    		<div class="row-input">
    			<input type="text" data-allow="login" name="login_name" placeholder="请输入用户登录名" maxlength="12">
    		</div>
    	</div>
        <?php if($action == 'add'): ?><div class="detail-row">
            <div class="row-label">
                <span>初始密码:</span>
            </div>
            <div class="row-input">
                <span class="notice">初始密码为:&nbsp&nbsp<span class="red">admin321</span></span>
            </div>
        </div><?php endif; ?>
       <?php if($action != 'add' ): ?><div class="detail-row">
            <div class="row-label">新密码</div>
            <div class="row-input">
                <input type="password" data-allow="login" name="newpwd" placeholder="请输入新密码" maxlength="16">
            </div>
        </div><?php endif; ?>
        <div class="detail-row">
            <div class="row-label">
                <span>姓名:</span>
            </div>
            <div class="row-input">
                <input type="text"  name="true_name" placeholder="请输入用户姓名" maxlength="12">
            </div>
        </div>
        <div class="detail-row">
            <div class="row-label">
                <span>用户编号:</span>
            </div>
            <div class="row-input">
                <input type="text" data-allow="number" name="staff_num" placeholder="请输入用户编号" maxlength="5">
            </div>
        </div>
        <div class="detail-row">
            <div class="row-label">
                <span>用户头像:</span>
            </div>
            <div class="row-input">
                <a href="javascript:;" class="file" id="upload_btn">选择文件 </a>  
            </div>
        </div>
        <div class="detail-row">
            <div class="row-label">
                <span>头像预览:</span>
            </div>
            <div class="row-input">
                <div class="img-box">
                   
                </div>
                <input type="hidden" name="header_img">
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

<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/file_upload_v2.js"></script>
<script type="text/javascript">
$(function(){
    $('#upload_btn').fileUpload(function(t,arg){
        $('.img-box').html( '<img src="'+arg[0].src+'" />' );
        $("input[name='header_img']").val(arg[0].src);
    });
})      
const editObj = new edit();
editObj.saveurl='/admin/staff/edit/{id}/edit';
<?php if($action != 'add'): ?>editObj.setForm($("#edit_form"),<?=json_encode($data)?>);<?php endif; ?>
editObj.showImg=function(){
    if ( this.action !== 'add' ) {
        $(".img-box").html('<img src="'+this.saveData.header_img+'" width="100px" height="100px">');
    }
}
editObj.showImg();
</script>

</body>
</html>