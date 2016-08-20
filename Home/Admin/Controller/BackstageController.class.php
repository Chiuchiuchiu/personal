<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/4/18
 * Time: 21:27
 */

namespace Admin\Controller;


use Parent\Controller\PersonalController;
use Think\Controller;

class BackstageController extends PersonalController
{
    public function HomePage(){
        $this->display('homePage');
    }
} 