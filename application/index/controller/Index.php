<?php

namespace app\index\controller;

use app\index\model\User;
use think\Db;

class Index
{

    public function index()
    {
        return json((Db::table('user')->select()));
//        $userModel =new User();
//        return $userModel->add(array(
//            "name"=>"hahh",
//            "password"=>"123456"
//        ));
//        return json($userModel->find(1));
    }

    public function hello(){
        return 'hello';
    }
}
