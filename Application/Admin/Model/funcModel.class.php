<?php
namespace Admin\Model;
use Common\Library\SearchModel;
class funcModel extends SearchModel{
	protected $tableName='background_func';
	public function single($key){
		$ret=$this->where(['key'=>$key])->find();
		return $ret;
	}
	public function pageData(){
		$this->setSearch($this);
		$ret['page']=$this->setPage($this);
		$this->setSearch($this);
		$ret['data']=$this->select();
		return $ret;
	}
	public function allKey(){
		$tmp=$this->select();
		return $tmp;
	}
}