<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Library\Admin;
class CommonController extends Controller{
	public $admin;
	public function __construct(){
		parent::__construct();
		$this->checkUserLogin();
	}
	private function checkUserLogin(){
		$admin=$this->loadAdmin();
		if ( !$admin->isLogin() ) {
			$this->redirect('admin/login/index');
		}else{
			$this->admin=$admin;
		}
	}
	private function loadAdmin(){
		$obj=session( \Common\Library\Admin::SESSION_SAVE_KEY );
		if ( empty($obj) ) {
			return new \Common\Library\Admin();
		}else{
			return unserialize($obj);
		}
	}
}