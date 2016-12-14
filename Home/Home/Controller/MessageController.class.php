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

        $list = $this->getCommlist();
        $html = $this->html($list);

        var_dump($_SESSION);
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
        $arr = M('Message')->field('id, fdParentId, fdUserId, fdContent, fdAddTime')
            ->where(['fdParentId' => $parent_id, 'fdDel' => 0])
            ->order('fdAddTime DESC')
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
        if(!$list) return false;
        $html = '';
        foreach($list as $k => $v){
            $html .= '<div class="col-md-12 col-sm-6 col-xs-6 col-xxs-12 wow fadeInUp mes" data-wow-duration="1s" data-wow-delay="1.1s">';
            $html .= '<div class="fh5co-icon"> <h4 style="margin:6px 0 0 0;font-size: medium">';
            if($list[$k]['fdParentId']){
                $html .= $list[$k]['fdUserId'] . "&nbsp;<span style='font-family:\"Microsoft YaHei\", \"微软雅黑\"'>评论:</span>&nbsp;" . $list[$k]['fdParentId'];
            }else{
                $html .= $list[$k]['fdUserId'];
            }

            $html .= '</h4><a style="float: right;font-size: small" href="javascript:;" class="reply">回复</a>';
            if($this->type_id == 1){
                $html .= '<a style="float: right;font-size: small" href="javascript:;" class="reply">删除</a>';
            }

            $html .='</div>';
            $html .= '<div class="fh5co-desc">';
            $html .= '<p style="margin-bottom:0px;">' . $list[$k]['fdContent'] . '</p>';
            if($list[$k]['children']){
                $html .= $this->html($list[$k]['children']);
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

    }
} 