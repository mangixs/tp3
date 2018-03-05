<?php
namespace Admin\Model;
use Common\Library\SearchModel;
class MenuModel extends SearchModel{
	public function pageData(){
		$this->setSearch($this);
		$this->where(['parent'=>0]);
		$ret['page']=$this->setPage($this);
		$this->setSearch($this);
		$this->where(['parent'=>0]);
		$ret['data']=$this->field('id,named,url,level,parent,sort')->select();
		return $ret;
	}
	public function childData($pid){
		$tmp=$this->where(['parent'=>$pid])->field('id,named,url,level,parent,sort')->select();
		return $tmp;
	}
    public function allMenu(){
        $res=$this->field('id,named,level,parent')->select();
        $data=[];
        foreach ($res as $k => $v) {
            $data[ $v['parent'] ][ $v['id'] ]=$v;
        }
        $tree=[];
        $this->treeMenu($data,0,$tree);
        return $tree;
    }
    private function treeMenu(&$data,$pid,&$tree){
        if( isset( $data[ $pid ] ) ){
            foreach( $data[ $pid ]  as $k=>$v){
                $tree[ $k ]=$v;
                $this->treeMenu($data,$k,$tree);
            }
        }
    }
    public function single($id){
    	return $this->where(['id'=>$id])->find();
    }
}