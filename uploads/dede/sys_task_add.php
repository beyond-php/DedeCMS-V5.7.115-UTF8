<?php
/**
 * 增加任务
 *
 * @version        $Id: sys_task_add.php 1 23:07 2010年7月20日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require(dirname(__FILE__)."/config.php");
CheckPurview('sys_Task');
if(empty($dopost)) $dopost = '';

if($dopost=='save')
{
    $starttime = empty($starttime) ? 0 : GetMkTime($starttime);
    $endtime = empty($endtime) ? 0 : GetMkTime($endtime);
    $runtime = $h.':'.$m;
    $Query = "INSERT INTO `#@__sys_task`(`taskname`,`dourl`,`islock`,`runtype`,`runtime`,`starttime`,`endtime`,`freq`,`lastrun`,`description`,`parameter`,`settime`)
        VALUES('$taskname', '$dourl', '$nislock', '$runtype', '$runtime', '$starttime', '$endtime','$freq', '0', '$description','$parameter', '".time()."'); ";
    $rs = $dsql->ExecuteNoneQuery($Query);
    if($rs) 
    {
        ShowMsg('成功增加一个任务!', 'sys_task.php');
    }
    else
    {
        ShowMsg('增加任务失败!'.$dsql->GetError(), 'javascript:;');
    }
    exit();
}

include DedeInclude('templets/sys_task_add.htm');