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
        return M('visitors')->limit($first, $rows)->order('fdCreate DESC')->select();
    }
} 