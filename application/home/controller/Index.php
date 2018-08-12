<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\home\controller;
use app\admin\model\House;
use app\admin\model\Owner;
use app\admin\validate\Model;
use app\home\model\Document;
use app\user\model\Member;
use OT\DataDictionary;
use think\Config;
use think\Request;
use app\admin\validate;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class Index extends Home{

	//系统首页
    public function index(){
        $category = model('Category')->getTree();
        $document = new Document();
        $lists    = $document->lists(null);
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',model('Document')->page);//分页
        return $this->fetch();
    }

    public function service()
    {
        return $this->fetch();
    }

    public function find()
    {
        return $this->fetch();
    }

    public function house()
    {
        $houseModel=new House();
        $listZhu=$houseModel->where('status','eq',1)->where('type','eq',0)->select();

        $listShou=$houseModel->where('status','eq',1)->where('type','eq',1)->select();

         $this->assign('list',$listZhu);
         $this->assign('listShou',$listShou);
        return $this->fetch('house');
    }

    //详情
    public function houseDetail($id)
    {
        $houseModel=new House();
        $houseDetail=$houseModel->find($id);
        $this->assign('detail',$houseDetail);
        return $this->fetch();
    }

    public function shouDetail($id)
    {
        $houseModel=new House();
        $houseDetail=$houseModel->find($id);
        $this->assign('detail',$houseDetail);
        return $this->fetch();
    }

    public function user()
    {
        $user_id=is_login();
        $userModel=new Member();
        $userinfo=$userModel->find($user_id);
        $result=['username'=>$userinfo->nickname];
        $owner=$userinfo->getOwner;
        if($owner){
            $result['house']=$owner->house;
            $result['name']=$owner->name;
            $result['status']=$owner->status;
        }
        $this->assign('info',$result);
        return $this->fetch();
    }
    //业主认证
    public function owner()
    {
        if ( !is_login() ) {
            $this->error( '您还没有登陆',url('user/login/index') );
        }
          $user_id=is_login();
          $ownerModel=new Owner();
         if(\request()->isPost()){
            $ownerData=Request::instance()->post();
            $validate=new validate\Owner();
            if(!$validate->check($ownerData)){
                return $this->error($validate->getError());
            }
            $ownerData['user_id']=$user_id;
            $ownerModel->create($ownerData);
             return $this->success('提交成功,结果在2-3个工作日下达','index/service');
        }else{
             $userOwner=$ownerModel->where('user_id','eq',$user_id)->find();
             if($userOwner){
                 return $this->error('您的认证在处理中,请耐心等待');
             }
                 return $this->fetch();
         }

    }
//    //个人信息
//    public function info()
//    {
//        if ( !is_login() ) {
//            $this->error( '您还没有登陆',url('user/login/index') );
//        }
//        return $this->fetch();
//    }
    //我的报修
    public function repair()
    {
        if ( !is_login() ) {
            $this->error( '您还没有登陆',url('user/login/index') );
        }

        return $this->fetch();
    }

    public function ajaxRepair($p)
    {
        $user_id=is_login();
        $repair=new \app\admin\model\Repair();
        $myRepair=$repair->where('uid',$user_id)->order('create_time','desc')->limit(($p-1)*2,2)->select();
        if(!empty($myRepair)){
            $p+=1;
        }
        $data=['myRepair'=>$myRepair,'url'=>url('index/ajaxRepair',array('p'=>$p))];
        echo json_encode($data);
    }
    //报修详情
    public function repairDetail($id)
    {
        $repair=new \app\admin\model\Repair();
        $repairDetail=$repair->find($id);
        $this->assign('detail',$repairDetail);
        return $this->fetch();
    }
    //账单
    public function Bill()
    {
        $result=['status'=>true,'message'=>'服务器维护中'];
        if ( !is_login() ) {
            $result=['status'=>false,'message'=>'请登录','code'=>0];
            echo  json_encode($result);
            return;
        }
        $user_id=is_login();
        $ownerModel=new Owner();
        $owner=$ownerModel->where('user_id',$user_id)->where('status',1)->find();
        if(empty($owner)){
            $result=['status'=>false,'message'=>'您还未验证','code'=>-1];
            echo json_encode($result);
            return ;
        }
        echo json_encode($result);
    }
    //我的报名活动
    public function myactive()
    {
        if ( !is_login() ) {
            $result=['status'=>false,'message'=>'请登录','code'=>0];
            echo  json_encode($result);
            return;
        }
        $user_id=is_login();
        $ownerModel=new Owner();
        $owner=$ownerModel->where('user_id',$user_id)->where('status',1)->find();
        if(empty($owner)){
            $result=['status'=>false,'message'=>'您还未验证','code'=>-1];
            echo json_encode($result);
            return ;
        }

        $userModel=new Member();
        $userModel->find($user_id);
        $active=$userModel->active;


        $result=['status'=>true];
        foreach ($active as $v){
            $result['message'][$v['id']]=$v['title'];
        }
        echo json_encode($result);
    }
    //生活贴士
    public function shenghuo()
    {
        $document=new Document();
        $data=$document->where('category_id','in',[47,45,44])->limit(0,5)->select();
        $this->assign('list',$data);
        return $this->fetch();
    }

}
