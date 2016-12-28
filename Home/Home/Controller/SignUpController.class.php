<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/11/9
 * Time: 16:59
 * 前台用户注册
 */

namespace Home\Controller;


use Parent\Controller\BaseController;
use Think\Exception;


class SignUpController extends BaseController{
    /**
     * 注册页面
     */
    public function register()
    {
        if(IS_POST){

            $email = I('post.email', '', 'strip_tags,trim');
            $verify = I('post.verify', 0, 'intval');
            $phone = I('post.phone', 0);
            $password = I('post.password', '', 'strip_tags,trim');
            $nickname = I('post.nick_name', '', 'strip_tags,trim');

            $nickname || $this->ajaxResponse(40009, $this->config[40009]);
            $password || $this->ajaxResponse(40010, $this->config[40010]);
            $phone || $this->ajaxResponse(40013, $this->config[40013]);
            $email || $this->ajaxResponse(40012, $this->config[40012]);
            $verify || $this->ajaxResponse(40005, $this->config[40005]);

            regex_check('phone', $phone) || $this->ajaxResponse(40013, $this->config[40013]);
            regex_check('email', $email) || $this->ajaxResponse(40008, $this->config[40008]);

            $v_model = D('Verify');
            $u_model = D('Users');
            $ip = get_client_ip();

            //查找验证码是否存在
            $verify_list = $v_model->check_log($email);
            in_array($verify, $verify_list) || $this->ajaxResponse(40006, $this->config[40006]);

            //查找用户是否有重复
            $u_model->get_user($phone, '', $nickname, $email, 'count') && $this->ajaxResponse(50003, $this->config[50003]);

            //注册
            try{
                $v_model->startTrans();

                //更改验证码状态
                if($v_model->change_verify($email, $verify) === false){
                    $v_model->rollback();
                    throw new Exception('更新失败！');
                }

                $user_add = [
                    'fdMail' => $email,
                    'fdIp' => $ip,
                    'fdPhone' => $phone,
                    'fdPassword' => md5(md5($password)),
                    'fdNickName' => $nickname,
                    'fdAddTime' => time(),
                    'fdLogTime' => time(),
                    'fdDel' => 0,
                ];
                //更改验证码状态
                if($u_model->add_user($user_add) === false){
                    $v_model->rollback();
                    throw new Exception('添加失败！');
                }

                $v_model->commit();
                $this->ajaxResponse(20000, '注册成功:)请登录！');
            }catch (\Exception $e){
                $v_model->rollback();
                $this->ajaxResponse(99999, $e->getMessage());
            }

        }
        $this->display();
    }

    /**
     * 发送邮件验证码
     */
    //TODO:这功能以后可以做注册、推送等
    public function send_verify()
    {
        $mail = I('get.mail', '', 'strip_tags,trim');
        regex_check('email', $mail) || $this->ajaxResponse(40008, $this->config[40008]);

        $model = D('Verify');
        $log = $model->check_log($mail);
        count($log) > 2 && $this->ajaxResponse(50002, $this->config[50002]);

        $add_time = time();
        $verity_str = rand(1000,9999);
        $mail_config = C('MAIL_CONFIG');

        $send = send_email(
            $mail_config['SERVER'],
            $mail_config['SERVER_USERNAME'],
            $mail_config['SERVER_PWD'],
            $mail_config['SEND_FROM'],
            $mail,
            '来自zhaowenxi.com的验证码',
            '【zhaowenxi.com】感谢您的关注！验证码是：' . $verity_str . "。请及时使用，记住噢~5分钟后失效。"
        );

        //保存验证码，后续验证
        $add = $send === true ? $model->save_verify($verity_str, $mail, $add_time) : false;
        $add ? $this->ajaxResponse(20000, $this->config[20000]) : $this->ajaxResponse(50001, $this->config[50001]);
    }
} 