<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/11/15
 * Time: 11:11
 */
namespace Home\Model;

use Think\Model\RelationModel;

class VerifyModel extends RelationModel{

    public function save_verify($num, $mail, $add_time){

        $add = [
            'fdMail' => $mail,
            'fdVerify' => $num,
            'fdAddTime' => $add_time,
            'fdSendTime' => time(),
            'fdUsed' => 0,
            'fdState' => 1
        ];

        return $this->add($add);
    }

    public function check_log($mail){
        return $this->where(['fdMail' => $mail, 'fdState' => 1, 'fdUsed' => 0])->getField('id, fdVerify');
    }

    public function change_verify($mail, $verify){
        $where['fdMail'] = $mail;
//        $where['fdVerify'] = $verify;
        return $this->where($where)->save(['fdUsed' => 1, 'fdState' => 0]);
    }
}
