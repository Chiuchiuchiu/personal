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
    $upload->maxSize = 3292200;
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
    $mail->setMail('=?utf8?B?' . base64_encode($title) . '?=', $content);
    return $mail->sendMail();
}

/**
 * @param $type
 * @param $str
 * @return int
 * 匹配正则
 */
function regex_check($type, $str){
    $rgx_arr = [
        'phone' => '/^(13|14|15|18|17)[0-9]{9}$/',
        'number' => '/^[0-9]+$/',
        'date' => '/^(\d{4})-(0?\d{1}|1[0-2])-(0?\d{1}|[12]\d{1}|3[01])$/',
        'date_time' => '/^(\d{4})-(0?\d{1}|1[0-2])-(0?\d{1}|[12]\d{1}|3[01])\s(0\d{1}|1\d{1}|2[0-3]):[0-5]\d{1}:([0-5]\d{1})$/',
        'email' => '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',
        'postcode' => '/[1-9]\d{5}(?!\d)/',
        'url' => '/\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/',
        'id_card' => '/(^\d{15}$)|(^\d{17}([0-9]|X|x)$)/',

    ];
    return preg_match($rgx_arr[$type], $str);
}

//缓存
function get_user($id){
    $key = 'user_' . $id;
    $v = S($key);
    if($v) return $v;
    $data = M('Users')->where(['id' => $id])->find();
    S($key, $data, 3600);
    return $data;
}

/**
 * 预防SQL注入，转义非法字符
 *
 * @param unknown_type $str
 * @return Ambigous <unknown, string>
 */
function setString($str)
{
    return get_magic_quotes_gpc() ? $str : addslashes($str);
}

/**
 * 把转译的字符返回没有转义前的样子
 *
 * @param string $str
 * @return string
 */
function unSetString($str)
{
    return stripslashes($str);
}

/**
 * 生成验证码
 * @param $length
 */
function create_verify($length){
    //验证码
    $Verify = new \Think\Verify();
    $Verify->codeSet = '0123456789';
    $Verify->imageH = '36';
    $Verify->imageW = '210';
    $Verify->length = $length;
    $Verify->fontSize = '20';
    $Verify->useCurve = false;
    $Verify->entry();
}


