<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/26
 * Time: 15:32
 * 公共方法
 */

function upload_pic($location, $model, $field){

    $upload = new \Think\Upload();// 实例化上传类
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->savePath  =      $location; // 设置附件上传目录    // 上传文件
    $info   =   $upload->upload();
    if(!$info) return $upload->getError(); // 上传错误提示错误信息

    //保存图片到数据库
    $data[$field] = $info[0]['savepath'];
    $data['fdCreate'] = date('Y-m-d H:i:s');
    $info['pic_id'] = M($model)->add($data);
    return $info;
}