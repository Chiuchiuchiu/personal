<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
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
            if (empty($post['userName']) || empty($post['password'])) {
                $this->message('帐号或密码不能为空！');
                return;
            }
            $user = D('Admin')->where(['fdName' => I('post.userName')])->find();
//            var_dump(md5(md5(I('post.password'))), $user);exit;
            if(!$user){
                $this->message('没有该用户');
                return;
            }
            if(md5(md5(I('post.password'))) != $user['fdPassword']){
                $this->message('密码不正确');
                return;
            }
            //给当前用户生成或更新一个token
            D('Admin')->where(['fdName' => I('post.userName')])->save(['fdToken' => md5(rand(0,10000)), 'fdLoginTime' => date('Y-m-d H:i:s')]);
            //写入session
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['fdName'];
            $_SESSION['type'] = $user['fdType'];
            $_SESSION['token'] = $user['fdToken'];

            $this->redirect('Backstage/HomePage');
            exit;
        }
        $this->display('login');
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