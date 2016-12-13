<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/11/9
 * Time: 14:53
 */

namespace Home\Controller;


use Parent\Controller\PersonalController;
use Think\Controller;

class MessageController extends Controller{

    /**
     * 添加留言
     */
    public function add(){

        $this->display();
    }

    /**
     * 删除留言
     */
    public function del(){

    }
} 