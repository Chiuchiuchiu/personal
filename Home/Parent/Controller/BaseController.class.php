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
    public function __construct(){
        parent::__construct();
        $this->config = C('CODE_AND_MSG');
    }

    protected function ajaxResponse($code = 20000, $message){
        $this->ajaxReturn(['code' => $code, 'msg' => $message]);
    }
}