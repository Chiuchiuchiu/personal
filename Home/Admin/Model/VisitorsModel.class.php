<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/23
 * Time: 11:10
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class VisitorsModel extends RelationModel{

    public function get_visitor_list($first, $rows){
        return M('visitors')->limit($first, $rows)->order('fdCreate DESC')->select();
    }
}
