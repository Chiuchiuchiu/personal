<?php
/**
 * Created by PhpStorm.
 * User: win7
 * Date: 2016/12/28
 * Time: 11:50
 */

namespace Home\Model;


use Think\Model\RelationModel;

class MessageModel extends RelationModel{
    /**
     * 递归获取评论
     * @param int $parent_id
     * @param array $result
     * @return array|bool
     */
    public function getCommlist($parent_id = 0,&$result = array())
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
} 