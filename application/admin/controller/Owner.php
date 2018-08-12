<?php
namespace app\admin\controller;

//认证
use think\Request;

class Owner extends Admin{
    public function index(){

        $ownerModel=new \app\admin\model\Owner();
        $ownerData=$ownerModel->paginate(3);
        $this->assign('list',$ownerData);
        return $this->fetch();
    }

    public function show($id)
    {
        $ownerModel=new \app\admin\model\Owner();
        $list=$ownerModel->find($id);
        $all=$ownerModel->where('house',$list['house'])->where('status',1)->select();
        $this->assign('all',$all);
        $this->assign('list',$list);
        return $this->fetch('show');
    }

    public function pass($id,$code)
    {
        $ownerModel=new \app\admin\model\Owner();
        $result=$ownerModel->update(['status'=>$code,'id'=>$id]);
        if($result){
           return $this->success('操作成功','index');
        }else{
            return $this->error('操作失败','show?id='.$id);
        }

    }
}