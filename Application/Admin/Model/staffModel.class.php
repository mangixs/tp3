<?php
namespace Admin\Model;
use Common\Library\SearchModel;
class staffModel extends SearchModel {
	public function checkUser($username,$pwd){
		$res=$this->where(['login_name'=>$username,'pwd'=>md5($pwd)])->find();
		return $res;
	}
	public function checkAdminPwd($id,$pwd){
		$res=$this->field('id')->where(['id'=>$id,'pwd'=>md5($pwd)])->find();
		if ( empty($res) ) {
			return true;
		}else{
			return false;
		}
	}
	public function checkPwd($id,$pwd){
		$data['pwd']=md5($pwd);
		$this->where(['id'=>$id])->save($data);
	}
	public function pageData(){
		$this->setSearch($this);
		$ret['page']=$this->setPage($this);
		$this->setSearch($this);
		$ret['data']=$this->field('id,login_name,true_name,staff_num')->select();
		return $ret;
	}
	public function single($id){
		$ret=$this->where(['id'=>$id])->find();
		return $ret;
	}
	public function deleteStaff($id){
		$this->where(['id'=>$id])->delete();
	}
	public function hasJob($id){
		$ret=D('staff_job')->field('job_id')->where(['staff_id'=>$id])->select();
		$res=[];
		foreach ($ret as $v) {
			$res[]=$v['job_id'];
		}		
		return $res;
	}
	public function getKey($id){
		$map['admin_job_id']  = array('in',$id);
        $data=D('admin_job_auth')->field('func_key,auth_key')->distinct(true)->where($map)->select();
        foreach ($data as $k => $v) {
            if ( empty($res_func[ $v['func_key'] ] ) ) {
                $res_func[ $v['func_key'] ]= [
                    'func_key'=>$v['func_key'],
                    'auth_key'=>[],
                ];
            }
            if ( !in_array( $v['auth_key'], $res_func[ $v['func_key'] ]['auth_key'] ) ) {
                $res_func[ $v['func_key'] ]['auth_key'][]=$v['auth_key'];
            }
        }
        return $res_func;
    }
}