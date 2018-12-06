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
        $data = [
            'name' => $name,
            'psd' => $psd
        ];
        $userV = new VUser();
        if (!$userV->check($data)) {
            return "登录失败";
        } else {
            try {
                $model = $this->where("name", $name)->find();
                if (!empty($model)) {
                    if (md5($data['psd']) == $model->getData()['psd']) {
                        $debug = Request::instance()->header('debug');
                        $sessionId = md5($model['id'] . time());
                        if ($debug) {
                            echo($sessionId);
                        }
                        cache($sessionId, $model->getData(), 60 * 60);
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

    /**
     * 获取用户信息
     */
    public function getUserInfo()
    {
        $sessionId = Request::instance()->header('sessionId');
        if (empty($sessionId)) {
            return '请传入sessionId';
        }
        $memberInfo = cache($sessionId);
        if (!$memberInfo) {
            return 'sessionId已过期,请重新登录';
        } else {
            try {
                $model = $this->where("id", $memberInfo['id'])->find();
                return json($model->getData());
            } catch (DataNotFoundException $e) {
                return '无此用户';
            } catch (ModelNotFoundException $e) {
                return '无此用户';
            } catch (DbException $e) {
                return '数据库出现问题';
            }
        }
    }

    /**
     * 上传用户头像
     */
    public function uploadsPortrait()
    {
        $sessionId = Request::instance()->header('sessionId');
        if (empty($sessionId)) {
            return '请传入sessionId';
        }
        $memberInfo = cache($sessionId);
        if (!$memberInfo) {
            return 'sessionId已过期,请重新登录';
        } else {
            $movePath = ROOT_PATH . 'public' . DS . 'uploads' . DS . $memberInfo['id'];
            $fileName = 'portrait.png';
            $file = Request::instance()->file('portrait');
            if (!empty($file)) {
                $file->validate(['size' => 10 * 1024 * 1024, 'ext' => 'jpg,png,gif'])->rule('date')->move($movePath, $fileName);
                $this->save([
                    'portrait' => $movePath . DS . $fileName,
                ], ['id' => $memberInfo['id']]);
                return json($this->where('id', $memberInfo['id']) ->field('portrait')->find());
            } else {
                return '上传文件为空';
            }

        }
    }

}