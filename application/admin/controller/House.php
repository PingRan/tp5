<?php
namespace app\admin\controller;

//房屋模块
use think\Request;

class House extends Admin{

    public function index()
    {

        $houseModel=new \app\admin\model\House();
        $houseList=$houseModel->paginate(3);


        $this->assign('list',$houseList);
        return $this->fetch();
    }
    //添加房屋信息
    public function add()
    {
      if(request()->isPost()){
          $houseModel=model('House');
          $requestData=Request::instance()->post();
          $validate=validate('house');
          if(!$validate->check($requestData)){
              return $this->error($validate->getError());
          };
          $requestData['rental_time']=strtotime($requestData['rental_time']);
          $requestData['end_time']=strtotime($requestData['end_time']);
          $result=$houseModel->create($requestData);
          if($result){

              $this->success('新增成功', url('index'));
          }else{
              $this->error('添加失败',url('Repair/add'));
          }
      }
          return $this->fetch();
    }


    public function edit($id)
    {
        $houseModel=model('house');
        if(request()->isPost()){
            $validate=validate('house');
            $requestData=Request::instance()->post();
            if(!$validate->check($requestData)){
                return $this->error($validate->getError());
            }
            if(empty($requestData['cover_id'])){

               $requestData['cover_id']=10;
            }

            $requestData['rental_time']=strtotime($requestData['rental_time']);
            $requestData['end_time']=strtotime($requestData['end_time']);
            $result=$houseModel->update($requestData);
            if($result){
                return $this->success('修改成功',url('index'));
            }else{
                return $this->error('修改失败',url('edit?id='.$requestData['id']));
            }
        }

        $data=$houseModel->find($id);
        return $this->fetch('edit',['house'=>$data]);
    }

    public function del()
    {
        $id = array_unique((array)input());
        if(isset($id['ids'])){
            \app\admin\model\House::destroy($id['ids']);

        }else{
            \app\admin\model\House::where('id','=',$id['id'])->delete();
        }

        $this->success('删除成功',url('index'));
    }

}