<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/23
 * Time: 9:18
 */

namespace Parent\Controller;

use Think\Controller;

class BaseController extends Controller{

    protected $config = '';
    protected $user_id = null;
    protected $type_id = null;
    protected $user_name = null;
    protected $user_token = null;

    public function _initialize()
    {
        $this->user_id = session('id');
        $this->type_id = session('type');
        $this->user_name = session('name');
        $this->user_token = session('token');

        preg_match('/^\w+/', $_SERVER['HTTP_HOST'], $matches);
        $this->assign('type_id', $this->type_id);
        $this->assign('user_id',$this->user_id);
        $this->assign('name', session('name'));
    }

    public function __construct(){
        parent::__construct();
        $this->config = C('CODE_AND_MSG');
    }

    protected function ajaxResponse($code = 20000, $message){
        $this->ajaxReturn(['code' => $code, 'msg' => $message]);
    }
}