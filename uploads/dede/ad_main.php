<?php
/**
 * 广告管理
 *
 * @version        $Id: ad_main.php 1 8:26 2010年7月12日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__).'/config.php');
require_once(DEDEINC.'/datalistcp.class.php');
require_once(DEDEINC.'/common.func.php');
setcookie('ENV_GOBACK_URL',$dedeNowurl,time()+3600,'/');

$clsid = isset($clsid)? intval($clsid) : 0;
$keyword = isset($keyword)? addslashes($keyword) : '';

$dsql->Execute('dd','SELECT * FROM `#@__myadtype` ORDER BY id DESC');
$option = '';
while($arr = $dsql->GetArray('dd'))
{
    if ($arr['id'] == $clsid)
    {
        $option .= "<option value='{$arr['id']}' selected='selected'>{$arr['typename']}</option>\n\r";
    } else {
        $option .= "<option value='{$arr['id']}'>{$arr['typename']}</option>\n\r";
    }
}
$where_sql = ' 1=1';
if($clsid!=0) $where_sql .= " AND clsid = $clsid";
if($keyword!='') $where_sql .= " AND (ad.adname like '%$keyword%') ";

$sql = "SELECT ad.aid,ad.clsid,ad.tagname,tp.typename as typename,ad.adname,ad.timeset,ad.endtime,ap.typename as clsname
FROM `#@__myad` ad 
LEFT JOIN `#@__arctype` tp on tp.id=ad.typeid 
LEFT JOIN `#@__myadtype` ap on ap.id=ad.clsid
WHERE $where_sql
ORDER BY ad.aid desc";
$dlist = new DataListCP();
$dlist->SetTemplet(DEDEADMIN."/templets/ad_main.htm");
$dlist->SetSource($sql);
$dlist->display();

function TestType($tname, $type="")
{
    if($tname=="")
    {
        return ($type == 1)? "默认分类" : "所有栏目";
    }
    else
    {
        return $tname;
    }
}

function TimeSetValue($ts)
{
    if($ts==0)
    {
        return "不限时间";
    }
    else
    {
        return "限时标记";
    }
}