<?php
/**
 * 内容属性
 *
 * @version        $Id: content_att.php 1 14:31 2010年7月12日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('sys_Att');
if(empty($dopost)) $dopost = '';

//保存更改
if($dopost=="save")
{
    $startID = 1;
    $endID = $idend;
    for(; $startID<=$endID; $startID++)
    {
        $att = ${'att_'.$startID};
        $attname = ${'attname_'.$startID};
        $sortid = ${'sortid_'.$startID};
        $query = "UPDATE `#@__arcatt` SET `attname`='$attname',`sortid`='$sortid' WHERE att='$att' ";
        $dsql->ExecuteNoneQuery($query);
    }
    echo "<script> alert('成功更新自定文档义属性表！'); </script>";
}

include DedeInclude('templets/content_att.htm');