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
        $CATEGORY_TYPE = C('CATEGORY_TYPE');
        $count = $model->count();
        $page = new Page($count, 10);

        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $show = $page->show();

        $list = $model->get_list($page->firstRow, $page->listRows);

        foreach($list as &$v){
            $v['cate'] = $CATEGORY_TYPE[$v['fdCategoryId']];
            $v['photo'] = $v['fdUrl'];
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
                $add_data[$key]['fdUrl'] = '/Public/uploads/' . $v['savepath'] . $v['savename'];
                $add_data[$key]['fdName'] = $_FILES['file']['name'][$key];
                $add_data[$key]['fdCategoryId'] = $post['cate'];
                $add_data[$key]['fdCreate'] = time();
            }

            $add = D('Photo')->add_log($add_data);
            $add == 0 && $this->error('上传失败');
            $this->success('成功', U('File/photo_list'));
            exit;
        }

        $this->assign('category', C('CATEGORY_TYPE'));
        $this->display();
    }

    /**
     * 删除图片包括文件
     */
    public function del_pic(){
        //删除文件用@unlink()
        $id = I('get.id', 0, 'int');
        $id == 0 && $this->ajaxResponse(50000, $this->config[50000]);

        $photo_sql = D('Photo');

        /* 先删除数据库记录再删除文件 */
        $url = $photo_sql->where(['id' => $id])->getField('fdUrl');
        $del_path = $_SERVER['DOCUMENT_ROOT'] . $url; //根目录

        $photo_sql->where(['id' => $id])->delete() && @unlink($del_path); //删除

        $this->ajaxResponse(20000, $this->config[20000]);
    }
} 