<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/11/9
 * Time: 14:49
 */

namespace Admin\Controller;


use Parent\Controller\PersonalController;

class NoteController extends PersonalController{
    /**
     * 添加文章
     */
    public function add(){
        if(IS_POST){
            $post = I('post.');

            (empty($post['fdName']) || empty($post['fdText']) || empty($post['fdCategoryId'])) && $this->ajaxResponse(40007, C('CODE_AND_MSG')[40007]);
            $model = D('Note');
//            $model->add($post);

        }

        $this->display();
    }

    /**
     * 编辑文章
     */
    public function edit(){
        if(IS_POST){

        }

        $this->display();
    }
} 