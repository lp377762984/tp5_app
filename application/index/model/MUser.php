<?php

namespace app\index\model;

use app\index\validate\VUser;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\Request;

/**
 * Created by PhpStorm.
 * MUser.class: ASUS
 * Date: 2018/10/7
 * Time: 20:06
 */
class MUser extends Model
{
    protected $table = 'test_user';//设置表名，否则DbException

    public function register($name, $psd)
    {
        $data = [
            'name' => $name,
            'psd' => $psd
        ];
        $userV = new VUser();
        if (!$userV->check($data)) {
            return $userV->getError();
        } else {
            try {
                $model = $this->where("name", $name)->find();
                if (!empty($model)) {
                    return '用户已存在';
                } else {
                    $data['psd'] = md5($data['psd']);
                    return $this->save($data);
                }

            } catch (DataNotFoundException $e) {
                $data['psd'] = md5($data['psd']);
                return $this->save($data);
            } catch (ModelNotFoundException $e) {
                $data['psd'] = md5($data['psd']);
                return $this->save($data);
            } catch (DbException $e) {
                return "数据库出现问题";
            }
        }
    }

    public function login($name, $psd)
    {
        $expiredTime = 60 * 5;
        $data = [
            'name' => $name,
            'psd' => $psd
        ];
        $userV = new VUser();
        if (!$userV->check($data)) {
            return "登录失败";
        } else {
            try {
                $model = $this->where("name", $name)->field('id,name,psd')->find();
                if (!empty($model)) {
                    if (md5($data['psd']) == $model->getData()['psd']) {
                        $sessionId = createSession(md5($model['id'] . time()));
                        $this->cache($sessionId, $model, $expiredTime);
                        return '登录成功';
                    } else {
                        return '密码错误';
                    }
                } else {
                    return '用户不存在';
                }
            } catch (DataNotFoundException $e) {
                return '登录失败';
            } catch (ModelNotFoundException $e) {
                return '登录失败';
            } catch (DbException $e) {
                return "数据库出现问题";
            }
        }
    }

    private function createSession($id)
    {

    }

    public function getUserInfo()
    {
        $header = Request::instance()->header();
    }
}