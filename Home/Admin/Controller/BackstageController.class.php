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
use Think\Page;

class BackstageController extends PersonalController
{
    public function visitor_list(){
//        var_dump($_SESSION);
        $model = D('Visitors');
        $count = $model->count();
        $page = new Page($count, 10);

        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $show = $page->show();

        $list = $model->get_visitor_list($page->firstRow, $page->listRows);
//        var_dump($list);

        $this->assign('page',$show);
        $this->assign('list', $list);
        $this->display();
    }

    public function detail(){
        $id = I('get.id', 0, 'int');
        $info = D('Visitors')->IP_info($id);
//        var_dump($info);

        $this->assign('info', $info);
        $this->display();
    }

    public function del(){
        $id = I('get.id', 0, 'int');
        $id == 0 && $this->ajaxResponse(50000, C('CODE_AND_MSG')['50000']);
        D('Visitors')->where(['id' => $id])->delete() ? $this->ajaxResponse(20000, C('CODE_AND_MSG')['20000']) : $this->ajaxResponse(40004, C('CODE_AND_MSG')['40004']);

    }
} 