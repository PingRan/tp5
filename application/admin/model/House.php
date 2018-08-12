<?php
namespace app\admin\model;
use think\Model;
class House extends Model{

    public function imgUrl()
    {
        return $this->hasOne('Picture','id','cover_id')->field('path');
    }


}