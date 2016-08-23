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
    protected function ajaxResponse($code, $message){
        $this->ajaxReturn(['code' => $code, 'msg' => $message]);
    }
} 