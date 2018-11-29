<?php

namespace app\index\controller;

use app\index\model\MUser;
use think\Db;

class Index
{

    public function index()
    {
        //return json((Db::table('user')->select()));
        //$userModel =new MUser();
        return "php start!";
        //return json($userModel->find(1));
    }

    public function register($name, $psd)
    {
        $userModel = new MUser();
        return $userModel->register($name, $psd);
        //return json($userModel->find(1));
    }

    public function hello()
    {
        return 'hello';
    }
}
