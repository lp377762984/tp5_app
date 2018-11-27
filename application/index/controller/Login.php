<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/10/8
 * Time: 20:43
 */

namespace app\index\controller;
use app\index\model\User;
use think\Controller;

class Login extends Controller
{
    //http://localhost/index.php/index/Login/login/name/56454654
    //http://localhost/index.php/abc/56454654
    public function login($name="")
    {
        //$this->request->cookie()
        //Cookie::init(['prefix'=>'think_','expire'=>3600,'path'=>'/']);
        //Cookie::prefix('think_');
        //Cookie::set("asdas",$name,30);
        $user = new User();
        return $user->login($name, "123456");
        //$this->assign('domain',$this->request->url(true));
    }

}