<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/8/26
 * Time: 15:32
 * 公共方法
 */

/**
 * @param $rootPath 根目录
 * @param $savePath 保存位置
 * @return array|bool|string
 * 上传文件
 */
function upload_pic($rootPath, $savePath){

    $upload = new \Think\Upload();// 实例化上传类
    $upload->exts     = array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx');// 设置附件上传类型
    $upload->rootPath = $rootPath; // 设置附件上传根目录
    $upload->savePath = $savePath; // 设置附件上传目录
    $upload->autoSub  = false;  // 不要在上传目录下再生成一个日期文件夹
    $info   =   $upload->upload();

    return ($info ? $info : $upload->getError());

}

/**
 * @param $server
 * @param $server_user
 * @param $server_pwd
 * @param $from
 * @param $send_to
 * @param $title
 * @param $content
 * 发送邮件
 */
function send_email($server, $server_user, $server_pwd, $from, $send_to, $title, $content){
    vendor("SendMail.mail");
    $mail = new \MySendMail();
    $mail->setServer($server, $server_user, $server_pwd); //到服务器的SSL连接
    //如果不需要到服务器的SSL连接，这样设置服务器：$mail->setServer("smtp.126.com", "XXX@126.com", "XXX");
    $mail->setFrom($from);
    $mail->setReceiver($send_to);
    $mail->setMail($title, $content);
    $mail->sendMail();
}