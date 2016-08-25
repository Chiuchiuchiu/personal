<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
    public function Index(){

        $this->display('index');
    }

    /**
     * 保存访客信息
     */
    public function save_visitor(){
        $get = I('get.');
        $data['fdLng'] = $get['lng'];
        $data['fdLat'] = $get['lat'];
        $data['fdCreate'] = date('Y-m-d H:i:s');
        $data['fdIP'] = get_client_ip();
        D('Visitors')->add($data);
    }
}