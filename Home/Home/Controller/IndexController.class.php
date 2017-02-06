<?php
namespace Home\Controller;
use Parent\Controller\BaseController;
use Think\Controller;
use Think\Model;

class IndexController extends BaseController {
    public function index(){

        $this->assign('all_count', D('visitors')->count());
        $this->assign('day_count', D('visitors')->where(['fdCreate' => ['BETWEEN' => [strtotime(date('Y-m-d')), strtotime(date('Y-m-d 23:59:59'))]]])->count());
        $this->display('index');
    }

    /**
     * 保存访客信息
     */
    public function save_visitor(){
        $get = I('get.');
        $data['fdLng'] = $get['lng'];
        $data['fdLat'] = $get['lat'];
        $data['fdCreate'] = time();
        $data['fdIP'] = get_client_ip();
        D('Visitors')->add($data);
    }

    /**
     * 前台用户登录
     */
    public function login(){

        if(IS_POST){
            $user_name = I('user_name', '', 'strip_tags,trim');
            $user_pwd  = I('password', '', 'strip_tags,trim');

            $user_name || $this->ajaxResponse(40001, $this->config[40001]);
            $user_pwd || $this->ajaxResponse(40001, $this->config[40001]);

            $user_model = D('Users');
            $user = $user_model->get_user('', '', $user_name, '', 'find');
            $user || $this->ajaxResponse(40002, $this->config[40002]);
            $user['fdPassword'] == md5(md5($user_pwd)) || $this->ajaxResponse(40003, $this->config[40003]);

            /* 更新登录时间 */
            $user_model->update_user(['id' => $user['id']], ['fdIp' => get_client_ip(), 'fdLogTime' => time()]);

            /* 写入session */
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['fdNickName'];
            $_SESSION['type'] = $user['fdType'];

            $this->ajaxResponse(20000, $this->config[20000]);
        }

        $this->display();
    }

    /**
     * 游客登出
     */
    public function logout(){
        session(null);
        $this->ajaxResponse(20000, $this->config[20000]);
    }
}