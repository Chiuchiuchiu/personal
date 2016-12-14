<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/4/18
 * Time: 22:46
 * 用于后台控制层继承
 */

namespace Parent\Controller;

use Think\Controller;

class PersonalController extends BaseController{

    public function _initialize()
    {
        $id = session('id');
        if (empty($id)) {
            $this->error('未登录', U('Home/Index/Index'));
            return;
        }
    }
} 