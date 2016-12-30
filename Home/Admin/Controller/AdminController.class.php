<?php
namespace Admin\Controller;

use Parent\Controller\BaseController;
use Think\Controller;
class AdminController extends BaseController {
//    protected $trueTableName = 'tbAdmin';


    //空操作
//    public function _empty()
//    {
//        $this->error('未知操作');
//    }

    /**
     * 登录页
     */
    public function index(){
        if(IS_POST){

            $post=I('post.');
            $model = D('Admin');

            if (empty($post['username']) || empty($post['password'])) {
                $this->ajaxResponse(40001, C('CODE_AND_MSG')['40001']);
                return;
            }

            if(empty($post['verify'])){
                $this->ajaxResponse(40001, C('CODE_AND_MSG')['40005']);
                return;
            }
            if(!$this->check_verify($post['verify'])){
                $this->ajaxResponse(40001, C('CODE_AND_MSG')['40006']);
                return;
            }

            /* 是否存在该用户 */
            $user = $model->where(['fdName' => $post['username']])->find();
            if(!$user){
                $this->ajaxResponse(40002, C('CODE_AND_MSG')['40002']);
                return;
            }
            if(md5(md5($post['password'])) != $user['fdPassword']){
                $this->ajaxResponse(40003, C('CODE_AND_MSG')['40003']);
                return;
            }

            /* 写入session */
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['fdName'];
            $_SESSION['type'] = $user['fdType'];

            $this->ajaxResponse(20000, C('CODE_AND_MSG')['20000']);
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

    function create_verify($length = 1){
        //验证码
        $Verify = new \Think\Verify();
        $Verify->codeSet = '0123456789';
        $Verify->imageH = '40';
        $Verify->imageW = '100';
        $Verify->length = $length;
        $Verify->fontSize = '20';
        $Verify->useCurve = false;
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

}