<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/28
 * Time: 16:54
 */

namespace Admin\Controller;


use Parent\Controller\PersonalController;
use Think\Page;

class FileController extends PersonalController{
    public function photo_list(){
        $model = D('Photo');
        $count = $model->count();
        $page = new Page($count, 10);

        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $show = $page->show();

        $list = $model->get_list($page->firstRow, $page->listRows);

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }
} 