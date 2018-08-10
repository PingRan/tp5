<?php
namespace app\home\controller;
use app\admin\model;
use think\Request;
use app\admin\validate;
class Repair extends Home{


    public function add()
    {
        if ( !is_login() ) {
            $this->error( '您还没有登陆',url('user/login/index') );
        }

        if(request()->isPost()){
            $repairModel=new model\Repair();

            $repairData=Request::instance()->post();

            $validate=new validate\Repair();

            if(!$validate->check($repairData)){

                return $this->error($validate->getError());

            }

            $result=$repairModel->create($repairData);
            if($result){

                $this->success('新增成功', url('index'));
            }else{
                $this->error('添加失败',url('Repair/add'));
            }

        }
        return $this->fetch('add');
    }
}