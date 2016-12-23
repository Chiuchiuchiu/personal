<?php
/**
 * Created by PhpStorm.
 * User: zhaowenxi
 * Date: 2016/11/9
 * Time: 14:53
 */

namespace Home\Controller;

use Parent\Controller\BaseController;
use Think\Controller;

class MessageController extends BaseController{

    /**
     * 添加留言
     */
    public function add(){

        $html = $this->html($this->getCommlist());

        if(IS_POST){
            $content = $_POST['content'];
            $parent_id = I('post.parent_id', -1, 'intval');

            $content || $this->ajaxResponse(40015, $this->config[40015]);
            $parent_id < 0 && $this->ajaxResponse(50000, $this->config[50000]);

            $data['fdContent'] = $content;
            $data['fdParentId'] = $parent_id;
            $data['fdIP'] = $this->user_ip;
            $data['fdUserId'] = $this->user_id ?: 0;
            $data['fdAddTime'] = time();

            D('Message')->add($data) ? $this->ajaxResponse(20000, $this->config[20000]) : $this->ajaxResponse(40014, $this->config[40014]);
        }

        $this->assign('user_id', $this->user_id);
        $this->assign('html', $html);
        $this->display();
    }

    /**
     * 递归获取评论
     * @param int $parent_id
     * @param array $result
     * @return array|bool
     */
    protected function getCommlist($parent_id = 0,&$result = array())
    {
        $arr = D('Message')->alias('a')
            ->field('a.*, b.fdNickName')
            ->join('tbusers AS b ON a.fdUserId = b.id', 'LEFT')
            ->where(['a.fdParentId' => $parent_id, 'a.fdDel' => 0])
            ->order('a.fdAddTime DESC')
            ->limit(0, 15)
            ->select();

        if(empty($arr)) return false;

        foreach ($arr as &$cm) {
            $thisArr        = &$result[];
            $cm['children'] = $this->getCommlist($cm['id'], $thisArr);
            $thisArr        = $cm;
        }

        return $result;
    }

    /**
     * 递归嵌套评论html
     * @param $list
     * @return string
     */
    protected function html($list){
        if(!$list) return '<div class="col-md-12 col-sm-6 col-xs-6 col-xxs-12 wow fadeInUp mes"><a href="#send_msg" class="op">评论(0),抢个沙发<i class="icon-arrow-down"></i></a></div>';
        $html = '';
        foreach($list as &$v){
            $html .= '<div class="col-md-12 col-sm-6 col-xs-6 col-xxs-12 wow fadeInUp mes">';
            $html .= '<div class="fh5co-icon content"> <h4 style=";font-size: medium">';
            if($v['fdParentId']){
                $html .= "<span style='color: #ffffff'>" . ($v['fdNickName'] ?: (substr($v['fdIP'], 0, -3) . '***')) . "</span>&nbsp;<span style='color: gray; font-family:\"Microsoft YaHei\", \"微软雅黑\"'>回复:</span>";
            }else{
                $html .= "<span style='color: #ffffff'>" . ($v['fdNickName'] ?: (substr($v['fdIP'], 0, -3) . '***')) . "</span>";
            }

            $html .= '<div><span style="color:gray; margin-right: 10px;">' . date('Y-m-d H:i:s', $v['fdAddTime']) . '</span><a href="javascript:;" class="reply" uname="'. $v['fdNickName'] .'" cid="'. $v['id'] .'">回复</a></div></h4>';
            if($this->type_id == 1){
                $html .= '<a href="javascript:;" class="reply">删除</a>';
            }

            $html .='</div>';
            $html .= '<div class="fh5co-desc">';
            $html .= '<p style="word-wrap: break-word; margin:6px 0 0 0;">' . $v['fdContent'] . '</p>';
            if($v['children']){
                $html .= $this->html($v['children']);
            }
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
    /**
     * 删除留言
     */
    public function del(){
        $id = I('get.id', 0, "intval");
        $id || $this->ajaxResponse(50000, $this->config[50000]);
        D('Message')->where(['id' => $id])->save(['fdDel' => 1]) === false ? $this->ajaxResponse(40004, $this->config[40004]) : $this->ajaxResponse(20000, $this->config[20000]);
    }
} 