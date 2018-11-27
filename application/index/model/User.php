<?php
namespace app\index\model;
use think\Model;

/**
 * Created by PhpStorm.
 * User.class: ASUS
 * Date: 2018/10/7
 * Time: 20:06
 */
class User extends Model
{
    protected $table = 'user';
    protected $pk = 'id';

    public function add($user)
    {
        return $this->save($user);
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
    public function login($name,$password){
        return 'welcome '.$name.",your password is ".$password;
    }
}