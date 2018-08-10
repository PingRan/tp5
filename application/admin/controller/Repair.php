<?php
namespace app\admin\controller;
//在线报修
use think\Request;

class Repair extends Admin{
    public function index(){

        // 查询状态为1的用户数据 并且每页显示10条数据
        $repairList = \app\admin\model\Repair::paginate(1);
// 把分页数据赋值给模板变量list
        $this->assign('list', $repairList);
// 渲染模板输出
        return $this->fetch();

    }

    public function add()
    {
        if(request()->isPost()){
         $repairModel=model('repair');
         $repairData=Request::instance()->post();

         $validate=validate('repair');
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

    public function edit($id)
    {
        $repairModel=model('repair');
        if(request()->isPost()){
         $validate=validate('repair');
         $repairDate=Request::instance()->post();
          if(!$validate->check($repairDate)){

              return $this->error($validate->getError());
          }
          $result=$repairModel->update($repairDate);
          if($result){
              return $this->success('修改成功',url('index'));
          }else{
              return $this->error('修改失败',url('edit?id='.$repairDate['id']));
          }
        }

        $data=$repairModel->find($id);
        return $this->fetch('edit',['repair'=>$data]);
    }

    public function del()
    {
        $id = array_unique((array)input());
        if(isset($id['ids'])){
            \app\admin\model\Repair::destroy($id['ids']);

        }else{
            \app\admin\model\Repair::where('id','=',$id['id'])->delete();
        }

        $this->success('删除成功',url('index'));
    }
}