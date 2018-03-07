<?php
namespace Admin\Controller;
use Admin\Model\MenuModel;
use Common\Library\FormCheck;
class MenuController extends CommonController{
	private $key='menu';
	private $rule=[
		'menu_form'=>[
			'named'=>['name'=>'named','preg'=>':notnull','notice'=>'请输入名称'],
            'url'=>['name'=>'url','preg'=>'/[a-z|A-Z|\/]+/','notice'=>'请输入功能名称','not_null'=>false],
            'screen_auth'=>['name'=>'screen_auth','preg'=>':notnull','notice'=>'请设置权限'],
            'sort'=>['name'=>'sort','preg'=>':number','notice'=>'请输入排序','not_null'=>false],
            'parent'=>['name'=>'parent','preg'=>':number','notice'=>'请输入选择菜单父级'],				
            'icon'=>['name'=>'icon','preg'=>':notnull','notice'=>'请上传图标','not_null'=>false],
		],
	];
	public function index(){
		$data['title']='菜单管理';
		$data['key']=$this->admin->getFunc($this->key);
		$this->assign($data);
		return $this->display();
	}
	public function pageData(){
		$db=new \Admin\Model\MenuModel();
		$data=$db->pageData();
		return json($data);
	}
	public function childMenu(){
    	$pid=I('post.pid');
    	$db=new \Admin\Model\MenuModel();
    	$ret=$db->childData($pid);
    	if ( empty($ret) ) {
    		return json(['result'=>'EMPTY','msg'=>'无子菜单数据','pid'=>$pid]);
    	}
    	return json(['result'=>'SUCCESS','msg'=>'获取成功','data'=>$ret,'pid'=>$pid]);
    }
    public function add(){
    	$pid=I('get.pid');
    	$db=new \Admin\Model\MenuModel();
    	$job=new \Admin\Model\jobModel();
    	$all=$db->allMenu();
    	$func=$job->funcAuth();
    	$this->assign('all',$all);
    	$this->assign('pid',$pid);
    	$this->assign('action','add');
		$this->assign('func',$func);
    	return $this->display();
    }
    public function edit($id,$act){
    	$db=new \Admin\Model\MenuModel();
    	$job=new \Admin\Model\jobModel();
    	$all=$db->allMenu();
    	$data=$db->single($id);
    	$func=$job->funcAuth();
    	$this->assign('func',$func);
    	$this->assign('all',$all);
    	$this->assign('action',$act);
    	$this->assign('data',$data);
    	$this->assign('pid',$id);
    	return $this->display('Menu/add');
    }
	public function save(){
		$data['named']=I('post.named');
		$data['url']=I('post.url');
		$data['screen_auth']=$_POST['screen_auth'];
		$data['sort']=I('post.sort');
		$data['parent']=I('post.parent');
		$data['icon']=I('post.icon');
		$formObj = new FormCheck($this->rule);
		$checkResult=$formObj->checkFrom($data,'menu_form');
		if ( $checkResult['result'] !=='CHECK_PASS' ) {
			return json($checkResult);
		}
		$action=I('post.action');
		switch ($action) {
			case 'add':
				$id=$this->addMenu($data);
				break;
			case 'edit':
				$id=I('post.id');
				$this->editMenu($id,$data);
				break;
			default:
				# code...
				break;
		}
		return json(['result'=>'SUCCESS','msg'=>'操作成功','id'=>$id]);
	}
	private function addMenu($data){
		$db=new \Admin\Model\MenuModel();
		if ( $data['parent'] == 0 ) {
			$data['level']=0;
			$id=$db->add($data);
			return $id;
		}else{
			$parent=$db->single($data['parent']);
			$data['level']=(int)$parent['level']+1;
			$id=$db->add($data);
			return $id;
		}
	}
	private function editMenu($id,$data){
		$db=new \Admin\Model\MenuModel();
		if ( $data['parent'] == 0 ) {
			$data['level']=0;
			$db->where(['id'=>$id])->save($data);
		}else{
			$parent=$db->single($data['parent']);
			$data['level']=(int)$parent['level']+1;
			$db->where(['id'=>$id])->save($data);
		}
	}
	public function deleteMenu($id){
		$db=new \Admin\Model\MenuModel();
		if ( empty($id) and !is_numeric($id) ) {
			return json(['result'=>'ERROR','msg'=>'参数错误']);
		}
		$hasChild=$db->where(['parent'=>$id])->field('id,named')->select();
		if ( !empty($hasChild) ) {
			return json(['result'=>'ERROR','msg'=>'存在子菜单,不可删除']);
		}
		$db->where(['id'=>$id])->delete();
		return json(['result'=>'SUCCESS','msg'=>'删除成功']);
	}
}