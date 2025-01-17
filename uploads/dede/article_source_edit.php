<?php
/**
 * 文章来源编辑
 *
 * @version        $Id: archives_add.php 1 14:30 2010年7月12日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/oxwindow.class.php");
CheckPurview('sys_Source');
if(empty($dopost)) $dopost = '';
if(empty($allsource)) $allsource = '';
else $allsource = stripslashes($allsource);

$m_file = DEDEDATA."/admin/source.txt";

//保存
if($dopost=='save')
{
    $fp = fopen($m_file,'w');
    flock($fp,3);
    fwrite($fp,$allsource);
    fclose($fp);
    echo "<script>alert('Save OK!');</script>";
}
//读出
if(empty($allsource) && filesize($m_file)>0)
{
    $fp = fopen($m_file,'r');
    $allsource = fread($fp,filesize($m_file));
    fclose($fp);
}
$wintitle = "文章来源管理";
$wecome_info = "文章来源管理";
$win = new OxWindow();
$win->Init('article_source_edit.php','js/blank.js','POST');
$win->AddHidden('dopost','save');
$win->AddTitle("每行保存一个来源：");
$win->AddMsgItem("<textarea name='allsource' id='allsource' style='width:100%;height:300px'>$allsource</textarea>");
$winform = $win->GetWindow('ok');
$win->Display();