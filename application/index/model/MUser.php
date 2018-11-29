<?php

namespace app\index\model;

use app\index\validate\VUser;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;

/**
 * Created by PhpStorm.
 * MUser.class: ASUS
 * Date: 2018/10/7
 * Time: 20:06
 */
class MUser extends Model
{
    protected $table = 'test_user';//设置表名，否则DbException

    /**
     * @param $name
     * @param $psd
     * @return false|int|mixed
     */
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

    public function getUserById($id)
    {
        try {
            return $this->field($id)->find();
        } catch (\think\db\exception\DataNotFoundException $e) {
            return false;
        } catch (\think\db\exception\ModelNotFoundException $e) {
            return false;
        } catch (\think\exception\DbException $e) {
            return false;
        }
    }

    public function login($name, $password)
    {
        return 'welcome ' . $name . ",your password is " . $password;
    }
}