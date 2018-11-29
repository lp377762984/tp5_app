<?php
/**
 * Created by PhpStorm.
 * MUser: Administrator
 * Date: 2018/11/29
 * Time: 10:10
 */

namespace app\index\validate;


use think\Validate;

class VUser extends Validate
{
    protected $rule = [
        'name' => 'require|chsDash|max:25',
        'psd' => 'require|alphaDash|min:6'
    ];
    protected $message = [
        'name.require' => '请输入名称',
        'name.chsDash' => '名字只能是汉字、字母、数字和下划线及破折号',
        'name.max' => '名称最多不能超过25个字符',
        'psd.require' => '请输入密码',
        'psd.alphaDash' => '密码只能为为字母和数字，下划线及破折号',
        'psd.min' => '密码至少为6位',
    ];
}