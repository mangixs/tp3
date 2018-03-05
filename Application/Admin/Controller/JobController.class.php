<?php
namespace Admin\Controller;
use Admin\model\jobModel;
class JobController extends CommonController{
	public function index(){
		$data['title']='职位管理';
		$this->assign($data);
		return $this->display();
	}
	public function pageData(){
		$db= new \Admin\Model\jobModel();
		$data=$db->pageData();
		return json($data);
	}
	public function add(){
		$data['action']='add';
		$this->assign($data);
		return $this->display();
	}
	public function edit($id,$act){
		$db=new \Admin\Model\jobModel();
		$data['data']=$db->single($id);
		$data['action']=$act;
		$this->assign($data);
		return $this->display('Job/add');
	}
	public function save(){
		$data['job_name']=I('post.job_name');
		$data['explain']=I('post.explain');
		if ( empty($data['job_name']) ) {
			return json(['result'=>'ERROR','msg'=>'请输入职位名称']);
		}
		$db= new \Admin\Model\jobModel();
		$action=I('post.action');
		switch ($action) {
			case 'add':
				$id=$db->add($data);
				break;
			case 'edit':
				$id=I('post.id');
				$db->where(['id'=>$id])->save($data);
				break;
			default:
				# code...
				break;
		}
		return json(['result'=>'SUCCESS','msg'=>'操作成功','id'=>$id]);
	}
	public function deleteJob($id){
		if ( !is_numeric($id) ) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$db=new \Admin\Model\jobModel();
		$db->where(['id'=>$id])->delete();
		return json(['result'=>'SUCCESS','msg'=>'删除成功']);
	}
	public function setJob($id){
		$db=new \Admin\Model\jobModel();
		$func=$db->funcAuth();
		$ret=$db->hasAuth($id);
		$this->assign('func',$func);
		$this->assign('has',$ret);
		$this->assign('admin_job_id',$id);
		return $this->display('Job/set');		
	}
	public function setauth(){
    	$data['admin_job_id']=I('post.admin_job_id');
        $data['auth_key']=I('post.auth_key');
        $data['func_key']=I('post.func_key');
        $ret=$this->auth($data);
        if ( $ret ) {
        	return json(['result'=>'SUCCESS','msg'=>'删除成功']);
        }else{
        	return json(['result'=>'SUCCESS','msg'=>'添加成功']);
        }
    }
    private function auth($data){
    	$db=D('admin_job_auth');
        $cou=$db->where($data)->count();
        if( $cou>0 ){
            $db->where($data)->delete();
            return true;
        }
        else{
            $db->add($data);
            return false;
        }
    }
}