<?php
/**
 * 通行证设置
 *
 * @version        $Id: sys_passport.php 1 22:28 2010年7月20日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
if(!isset($dopost)) $dopost = "";

if($dopost=='save')
{
    $ConfigFile = DEDEINC."/config_passport.php";
    $vars = array('cfg_pp_need','cfg_pp_encode','cfg_pp_login','cfg_pp_exit','cfg_pp_reg');
    $configstr = "";
    foreach($vars as $v)
    {
        ${$v} = str_replace("'", "", ${$v});
        ${'edit___'.$v} = dede_htmlspecialchars(${'edit___'.$v});
        $configstr .= "\${$v} = '".str_replace("'","",${'edit___'.$v})."';\r\n";
    }
    $configstr = '<'.'?'."\r\n".$configstr.'?'.'>';
    $fp = fopen($ConfigFile, "w") or die("写入文件 $ConfigFile 失败，请检查权限！");
    fwrite($fp, $configstr);
    fclose($fp);
    echo "<script>alert('修改通行证配置成功！');window.location='sys_passport.php?".time()."';</script>\r\n";
}
include DedeInclude('templets/sys_passport.htm');