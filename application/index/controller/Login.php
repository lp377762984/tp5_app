<?php
/**
 * Created by PhpStorm.
 * MUser: ASUS
 * Date: 2018/10/8
 * Time: 20:43
 */

namespace app\index\controller;
use app\index\model\MUser;
use think\Controller;

class Login extends Controller
{
    //http://localhost/index.php/index/Login/login/name/56454654
    //http://localhost/index.php/abc/56454654
    public function login($name="")
    {
        $user = new MUser();
        return $user->login($name, "123456");
    }

}