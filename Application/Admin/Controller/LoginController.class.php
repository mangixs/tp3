<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\staffModel;
use Common\Library\Admin;
class LoginController extends Controller{
	public function index(){
		return $this->display();
	}
	public function sub(){
		$username = I("post.username");
		$pwd = I("post.pwd");
		if ( !preg_match("/^[\w]{5,16}$/", $username) ) {
			return json(['result'=>'ERROR','msg'=>'请输入正确的用户名']);
		}
		if ( !preg_match("/^[\w]{5,16}$/", $pwd) ) {
			return json(['result'=>'ERROR','msg'=>'请输入正确的密码']);
		}
		$db=new \Admin\Model\staffModel();
		$res=$db->checkUser($username,$pwd);
		if ( empty($res) ) {
			return json(['result'=>'ERROR','msg'=>'用户名密码错误']);
		}
		$hasJob=D('staff_job')->where(['staff_id'=>$res['id']])->select();
        if ( empty($hasJob) ) {
            return json(['result'=>'ERROR','msg'=>'该用户无后台管理权限']);
        }
        $jobId=[];
        foreach ($hasJob as $v) {
            $jobId[]=$v['job_id'];
        }
        $res['key']=$db->getKey($jobId);
		unset($res['pwd']);
		$admin= new \Common\Library\Admin(true);
		$admin->setInfo($res);
		$admin->setAuth($res['key']);
		$admin->save();
		$url=U('admin/index/index');
		return json(['result'=>'SUCCESS','msg'=>'登陆成功','url'=>$url]);
	}
}
