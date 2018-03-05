<?php
namespace Admin\Controller;
use Admin\Model\funcModel;
class FuncController extends CommonController{
	public function index(){
		$data['title']='功能管理';
		$this->assign($data);
		return $this->display();
	}
	public function add(){
		$data['action']='add';
		$this->assign($data);
		return $this->display();
	}
	public function edit($key,$act){
		$db=new \Admin\Model\funcModel();
		$data['data']=$db->single($key);
		$data['action']=$act;
		$this->assign($data);
		return $this->display('Func/add');
	}
	public function pageData(){
		$db=new \Admin\Model\funcModel();
		$data=$db->pageData();
		return json($data);
	}
	public function save(){
		$data['key']=I('post.key');
		$data['func_name']=I('post.func_name');
		if ( !preg_match("/^[a-zA-Z|_]+$/", $data['key'] ) ) {
			return json(['result'=>'ERROR','msg'=>'请输入正确的键名']);
		}
		if ( empty($data['func_name']) ) {
			return json(['result'=>'ERROR','msg'=>'请输入功能名称']);
		}
		$action=I('post.action');
		$db=new \Admin\Model\funcModel();
		switch ($action) {
			case 'add':
				$res=$db->where(['key'=>$data['key']])->find();
				if ( !empty($res) ) {
					return json(['result'=>'ERROR','msg'=>'键名已存在']);
				}
				$db->add($data);
				break;
			case 'edit':
				$db->where(['key'=>$data['key']])->save(['func_name'=>$data['func_name']]);
				break;
			default:
				# code...
				break;
		}
		return json(['result'=>'SUCCESS','msg'=>'操作成功','id'=>$data['key']]);
	}
	public function deleteFunc($key){
		if ( !preg_match("/^[a-zA-Z|_]+$/", $key ) ) {
			return json(['result'=>'ERROR','msg'=>'键名错误']);
		}
		$db=new \Admin\Model\funcModel();
		$db->where(['key'=>$key])->delete();
		return json(['result'=>'SUCCESS','msg'=>'删除成功']);
	}
	public function setFunc($key){
		if ( empty($key) and !is_string($key)) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$db=new \Admin\Model\funcModel();
		$data['data']=$db->single($key);
		$data['set']=D('func_auth')->where(['func_key'=>$key])->select();
		$this->assign($data);
		return $this->display('Func/set');
	}
	public function set(){
		$keys=I( 'post.key' );
		$names=I('post.extendname/a');
		$func_key=I('post.extendkey/a');
		$data=[];
		foreach( $func_key as $i=>$key ){
			$data[]=['key'=>$key,'func_key'=>$keys,'auth_name'=>$names[$i]];
		}
		D('func_auth')->where(['func_key'=>$key])->delete();
		D('func_auth')->addAll($data);
		return json(['result'=>'SUCCESS','msg'=>'操作成功']);
	}
}