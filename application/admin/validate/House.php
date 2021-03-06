<?php
namespace app\admin\validate;
use think\Validate;
class House extends Validate{

    protected $rule = [
        ['title', 'require|length:1,80', '标题不能为空|标题长度不能超过80个字符'],
        //['name', 'require|/^[\x{4e00}-\x{9fa5}]{2,5}$/u|', '名字不能为空|名字2-5个汉字'],
        ['tel', 'require|/^1[3,5,6,8]\w{9}$/', '请输入电话号码|电话号码不合法'],
    ];

}