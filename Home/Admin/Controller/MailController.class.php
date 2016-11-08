<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/11/8
 * Time: 11:36
 */

namespace Admin\Controller;

use Parent\Controller\PersonalController;

class MailController extends PersonalController{

    //发送邮件，以后可以做注册、推送等
    public function send_mail(){
        $mail_config = C('MAIL_CONFIG');
        send_email(
            $mail_config['SERVER'],
            $mail_config['SERVER_USERNAME'],
            $mail_config['SERVER_PWD'],
            $mail_config['SEND_FROM'],
            'XXX@126.COM',
            'tittle',
            'content'
        );

//        $mail->setServer("smtp.126.com", "chiuhey@126.com", "zwx881003"); //到服务器的SSL连接
//        //如果不需要到服务器的SSL连接，这样设置服务器：$mail->setServer("smtp.126.com", "XXX@126.com", "XXX");
//        $mail->setFrom("chiuhey@126.com");
//        $mail->setReceiver("chiuhey@126.com");
//        $mail->setMail("test", "中文test123");
//        $mail->sendMail();
    }
} 