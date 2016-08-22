<?php
namespace Admin\Controller;

use Parent\Controller\PersonalController;
use Think\Controller;
class AdminController extends PersonalController {
//    protected $trueTableName = 'tbAdmin';


    //空操作
    public function _empty()
    {
        $this->error('未知操作');
    }

    /**
     * 登录页
     */
    public function Index(){
        if(IS_POST){
            $post=I('post.');
            $model = D('Admin');
            if (empty($post['username']) || empty($post['password'])) {
                $this->ajaxResponse(40001, C('CODE_AND_MSG')['40001']);
                return;
            }
            $user = $model->where(['fdName' => $post['username']])->find();
//            var_dump(md5(md5(I('post.password'))), $user);exit;
            if(!$user){
                $this->ajaxResponse(40002, C('CODE_AND_MSG')['40002']);
                return;
            }
            if(md5(md5($post['password'])) != $user['fdPassword']){
                $this->ajaxResponse(40003, C('CODE_AND_MSG')['40003']);
                return;
            }
            //给当前用户生成或更新一个token
            $model->where(['fdName' => $post['username']])->save(['fdToken' => md5(rand(0,10000)), 'fdLoginTime' => date('Y-m-d H:i:s')]);
            //写入session
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['fdName'];
            $_SESSION['type'] = $user['fdType'];
            $_SESSION['token'] = $user['fdToken'];

            $this->ajaxResponse(20000, C('CODE_AND_MSG')['20000']);
            exit;
        }
        $this->display('login');
        exit;
    }

    /**
     * 弹出窗口  后退或跳转
     */
    public function message($ms,$url=''){
        header('Content-Type:text/html; charset= utf-8');
        $html='<script>alert("'.$ms.'");';
        $html.=empty($url)?'window.history.go(-1);</script>':'window.location.href="'.$url.'";</script>';
        echo $html;
    }

    public function Logout(){
        session(null);
        $this->redirect('login');
    }

}