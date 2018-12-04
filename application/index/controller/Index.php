<?php

namespace app\index\controller;

use app\index\model\MUser;
use think\Controller;
use think\Request;

class Index extends Controller
{

    public function index()
    {
        return "php start!";
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
}
