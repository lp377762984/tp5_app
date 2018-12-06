<?php

namespace app\index\controller;

use app\index\model\MUser;
use think\Controller;
use think\Request;

class Index extends Controller
{

    public function index()
    {
        $this->assign('name','ThinkPHP');
        return $this->fetch('hello');
    }

    public function register($name, $psd)
    {
        $userModel = new MUser();
        return $userModel->register($name, $psd);
    }

    public function login($name, $psd)
    {
        $userModel = new MUser();
        return $userModel->login($name, $psd);
    }

    public function userInfo()
    {
        $userModel = new MUser();
        return $userModel->getUserInfo();
    }

    public function uploadsPortrait()
    {
        $userModel = new MUser();
        return $userModel->uploadsPortrait();
    }
}
