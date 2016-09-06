<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/28
 * Time: 16:57
 */

namespace Admin\Model;


use Think\Model\RelationModel;

class PhotoModel extends RelationModel{
    public function get_list($first, $rows){
        return M('Photo')->limit($first, $rows)->order('fdCreate DESC')->select();
    }

    public function add_log($data){
        return M('Photo')->addAll($data);
    }
} 