<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
    public function Index(){
        $data['fdCreate'] = date('Y-m-d H:i:s');
        $data['fdIP'] = get_client_ip();
        D('Visitors')->add($data);
        $this->display('index');
    }
}