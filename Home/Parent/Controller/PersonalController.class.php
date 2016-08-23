<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/4/18
 * Time: 22:46
 */

namespace Parent\Controller;

use Think\Controller;

class PersonalController extends BaseController{

    protected $user_id = null;
    protected $type_id = null;
    protected $user_name = null;
    protected $user_token = null;

    public function _initialize()
    {
        $id = session('id');
        if (empty($id)) {
            $this->error('未登录', U('Home/Index/Index'));
            return;
        }
        $this->user_id = session('id');
        $this->type_id = session('type');
        $this->user_name = session('name');
        $this->user_token = session('token');

        preg_match('/^\w+/', $_SERVER['HTTP_HOST'], $matches);
        $this->assign('type_id', $this->type_id);
        $this->assign('user_id',$this->user_id);
        $this->assign('name', session('name'));
    }
} 