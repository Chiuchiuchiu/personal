<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
    public function index(){
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
     * 游客登录
     */
    public function login(){

    }

    /**
     * 游客登出
     */
    public function logout(){
        session(null);
        $this->redirect('index');
    }
}