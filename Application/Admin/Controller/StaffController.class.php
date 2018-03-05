<?php
namespace Admin\Controller;
use Admin\Model\staffModel;
use Common\Library\FormChech;
use Admin\Model\jobModel;
class StaffController extends CommonController{
	private $rule=[
		'staff_form'=>[
			'login_name'=>['name'=>'login_name','preg'=>'/^[\w|_]{4,}$/','notice'=>'请输入正确的登录名!'],
            'staff_num'=>['name'=>'staff_num','preg'=>':number','notice'=>'请输入正确的用户编号!'],
            'true_name'=>['name'=>'true_name','preg'=>':ch','notice'=>'请输入正确的用户名!','not_null'=>false],
            'header_img'=>['name'=>'header_img','preg'=>':notnull','notice'=>'请上传用户头像','not_null'=>false],				
		],
	];
	public function index(){
		$data['title']='后台管理员管理';
		$this->assign($data);
		return $this->display();
	}
	public function pageData(){
		$db=new \Admin\Model\staffModel();
		$data=$db->pageData();
		return json($data);
	}
	public function add(){
		$data['action']='add';
		$this->assign($data);
		return $this->display();
	}
	public function save(){
		$data['login_name']=I('post.login_name');
		$data['staff_num']=I('post.staff_num');
		$data['true_name']=I('post.true_name');
		$data['header_img']=I('post.header_img');
		$action=I('post.action');
		$formObj= new \Common\Library\FormCheck($this->rule);
		$checkResult=$formObj->checkFrom($data,'staff_form');
		if ( $checkResult['result'] !=='CHECK_PASS' ) {
			return json($checkResult);
		}
		$data['updated_at']=date('Y-m-d H:i:s',time());
		$db= new \Admin\Model\staffModel();
		switch ($action) {
			case 'add':
				$data['created_at']=$data['updated_at'];
				$data['pwd']=md5('admin321');
				$id=$db->add($data);
				break;
			case 'edit':
				$id=I('post.id');
				$data['pwd']=md5( I('post.newpwd') );
				$db->where(['id'=>$id])->save($data);
				break;
			default:
				# code...
				break;
		}
		return json(['result'=>'SUCCESS','msg'=>'操作成功','id'=>$id]);
	}
	public function edit($id,$act){
		$db=new \Admin\Model\staffModel();
		$data['data']=$db->single($id);
		$data['action']=$act;
		$this->assign($data);
		return $this->display('Staff/add');
	}
	public function deleteStaff($id){
		if ( !is_numeric($id) ) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$db=new \Admin\Model\staffModel();
		$db->deleteStaff($id);
		return json(['result'=>'SUCCESS','msg'=>'删除成功']);
	}
	public function setJob($id){
		if (empty($id) and !is_numeric($id)) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$m=new \Admin\Model\jobModel();
		$db=new \Admin\Model\staffModel();
		$job=$m->allJob();
		$res=$db->hasJob($id);
		$this->assign('data',$job);
		$this->assign('has',$res);
		$this->assign('staff_id',$id);
		return $this->display('Staff/set');
	}
	public function jobSave(){
		$staff_id=I('post.staff_id');
		$job_id=I('post.job_id');
		$set=I('post.set')==='true'?true:false;
		if ( empty($staff_id) and empty( $job_id ) and !is_numeric($staff_id) and !is_numeric($job_id) and !is_bool($set) ) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$m=D('staff_job');
		$m->where(['staff_id'=>$staff_id])->where(['job_id'=>$job_id])->delete();
		if ( $set ) {
			$m->add(['staff_id'=>$staff_id,'job_id'=>$job_id]);
		}		
		$db=new \Admin\Model\staffModel();
		$res=$db->hasJob($staff_id);
		$db->where(['id'=>$staff_id])->save(['job'=>json_encode($res)]);
		return json(['result'=>'SUCCESS','msg'=>'设置成功']);
	}
}