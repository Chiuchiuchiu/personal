<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/11/15
 * Time: 15:46
 */

namespace Home\Model;

use Think\Model\RelationModel;

class UsersModel extends RelationModel{
    public function get_user($phone, $id, $username, $email, $type = 'count'){
        $phone && $where['fdPhone'] = $phone;
        $id && $where['id'] = $id;
        $username && $where['fdNickName'] = $username;
        $email && $where['fdMail'] = $email;
        $where['_logic'] = 'OR';

        return $this->where($where)->$type();
    }

    public function add_user($post){
        return $this->add($post);
    }
} 