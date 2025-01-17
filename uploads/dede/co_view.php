<?php
/**
 * @version        $Id: co_url.php 1 14:31 2010年7月12日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/dedecollection.class.php");
$backurl = isset($_COOKIE['ENV_GOBACK_URL']) ? $_COOKIE['ENV_GOBACK_URL'] : "co_url.php";
if(empty($action)) $action='';
if($aid=='')
{
    ShowMsg('参数无效!','-1');
    exit();
}

//保存更改
if($action=="save")
{
    $result = '';
    for($i=0;$i < $endid;$i++)
    {
        $result .= "{dede:field name=\\'".${"noteid_$i"}."\\'}".${"value_$i"}."{/dede:field}\r\n";
    }
    $dsql->ExecuteNoneQuery("UPDATE `#@__co_htmls` SET result='$result' WHERE aid='$aid'; ");
    ShowMsg("成功保存一条记录！",$backurl);
    exit();
}
$dsql->SetSql("SELECT * FROM `#@__co_htmls` WHERE aid='$aid'");
$dsql->Execute();
$row = $dsql->GetObject();
$isdown = $row->isdown;
$nid = $row->nid;
$url = $row->url;
$dtime = $row->dtime;
$body = $row->result;
$litpic = $row->litpic;
$fields = array();
if($isdown == 0)
{
    $co = new DedeCollection();
    $co->LoadNote($nid);
    $co->DownUrl($aid, $url, $litpic);
    $co->dsql->SetSql("SELECT * FROM `#@__co_htmls` WHERE aid='$aid'");
    $co->dsql->Execute();
    $row = $co->dsql->GetObject();
    $isdown = $row->isdown;
    $nid = $row->nid;
    $url = $row->url;
    $dtime = $row->dtime;
    $body = $row->result;
    $litpic = $row->litpic;
}
$dtp = new DedeTagParse();
$dtp->SetNameSpace("dede", "{", "}");
$dtp->LoadString($body);
include DedeInclude('templets/co_view.htm');