<?php
namespace app\home\controller;

//小区通告


use app\home\model\Document;
use app\home\model\Picture;

class Notice extends Home {
    public function index(){
         //小区通知列表

        return $this->fetch('notice');
    }

    //返回分页数据
    public function more($p){

        $Document=new Document();
        $notices=$Document->where('category_id',44)->limit(($p-1)*2,2)->select();
        if(!empty($notices)){
            $p=$p+1;
        }
        $picture=new Picture();

        foreach ($notices as &$v){
            $v['url']=$picture->field('path')->find($v['cover_id']);
        }

        $data=['notice'=>$notices,'p'=>$p];
        echo json_encode($data);
    }

    //小区通知详情
    public function detail($id)
    {
        $Document = new Document();
        /* 更新浏览数 */
        $map = array('id' => $id);
        $Document->where($map)->setInc('view');

        $info = $Document->detail($id);
        $info['create_time']=date('Y-m-d H:i:s',$info['create_time']);

        $this->assign('info',$info);
        return $this->fetch('notice-detail');
    }

    public function service(){

        return $this->fetch('service');
    }

    public function moreService($p){
        //小区通知列表
        $Document=new Document();
        $notices=$Document->where('category_id',45)->limit(($p-1)*1,1)->select();
        if(!empty($notices)){
            $p=$p+1;
        }
        $data=['notice'=>$notices,'p'=>$p];
        echo json_encode($data);
    }
}