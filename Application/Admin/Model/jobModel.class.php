<?php
namespace Admin\Model;
use Common\Library\SearchModel;
use Admin\Model\funcModel;
class jobModel extends SearchModel{
	protected $tableName='admin_job';
	public function single($id){
		$ret=$this->where(['id'=>$id])->find();
		return $ret;
	}
	public function pageData(){
		$this->setSearch($this);
		$ret['page']=$this->setPage($this);
		$this->setSearch($this);
		$ret['data']=$this->field('id,job_name')->select();
		return $ret;
	}
	public function allJob(){
		$ret=$this->field('id,job_name')->where(['valid'=>1])->select();
		return $ret;
	}
	public function funcAuth(){
		$m=new \Admin\Model\funcModel();
		$func=$m->allKey();
		$auth=$this->auth_all();
		$tmp=[];
        foreach( $auth as $v ){
            $tmp[ $v['func_key'] ][]=$v;
        }
        $ret=[];
        foreach( $func as $k=>$v ){
            $ret[ $v['key'] ]=$v;
            if( array_key_exists( $v['key'],$tmp ) ){
                $ret[ $v['key'] ]['auth']=$tmp[ $v['key'] ];
            }
            else{
                $ret[ $v['key'] ]['auth']=[];
            }
        }
        return $ret;
	}
	private function auth_all(){
		$tmp=D('func_auth')->select();
		return $tmp;
	}
	public function hasAuth($id){
		$res=D('admin_job_auth')->where(['admin_job_id'=>$id])->select();
		$ret=[];
		foreach ($res as $v) {
			$ret[ $v['func_key'] ][]=$v['auth_key'];
		}
		return $ret;
	}
}