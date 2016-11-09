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
    public $root_path = './Public/uploads/';

    public function photo_list(){
        $model = D('Photo');
        $count = $model->count();
        $page = new Page($count, 10);

        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $show = $page->show();

        $list = $model->get_list($page->firstRow, $page->listRows);
        foreach($list as &$v){
            $v['cate'] = C('CATEGORY_TYPE')[$v['fdCategoryId']];
        }

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    public function upload_photo(){

        if(IS_POST){
            $post = I('post.');
            switch($post['cate']){
                case 1: //相册
                    $save_path = 'album/';break;
                case 2: //文章插图
                    $save_path = 'illustration/';break;
                case 3: //素材
                    $save_path = 'material/';break;
                default :
                    $save_path = 'material/';break;
            }
            $data['fdCategoryId'] = $post['cate'];

            $upload = upload_pic($this->root_path, $save_path);

            !is_array($upload) && $this->error($upload);
            $add_data = [];
            foreach($upload as $key => $v){
                $add_data[$key]['fdUrl'] = '/Public/' . $v['savepath'] . $v['savename'];
                $add_data[$key]['fdName'] = $_FILES['file']['name'][$key];
                $add_data[$key]['fdCategoryId'] = $post['cate'];
                $add_data[$key]['fdCreate'] = date('Y-m-d H:i:s');
            }

            $add = D('Photo')->add_log($add_data);
            $add == 0 && $this->error('上传失败');
            $this->success('成功', U('File/photo_list'));
            exit;
        }

        $this->assign('category', C('CATEGORY_TYPE'));
        $this->display();
    }

} 