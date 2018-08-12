<?php

namespace app\admin\validate;
use think\Validate;

class Owner extends Validate{

    protected $rule = [
        ['name','require|/^[\x{4e00}-\x{9fa5}]{2,5}$/u', '名字不能为空|名字2-5个汉字'],
        ['tel','require|/^1[3,5,6,8]\w{9}$/', '请输入电话号码|电话号码不合法'],
        ['house','require|length:1,20', '请填写房号'],
        ['ID_Card','require|/^[1-9]\d{17}/', '请填写身份证号'],
    ];
}