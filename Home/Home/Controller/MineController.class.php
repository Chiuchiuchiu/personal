<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/3/25
 * Time: 23:58
 */

namespace Home\Controller;


use Parent\Controller\BaseController;
use Think\Controller;

class MineController extends BaseController{
    public function mine(){
        $this->display('mine');
    }
} 