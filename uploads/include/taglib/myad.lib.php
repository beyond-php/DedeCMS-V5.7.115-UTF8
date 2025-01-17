<?php   if(!defined('DEDEINC')) exit('DedeCMS Error: Request Error!');
/**
 * 广告调用
 *
 * @version        $Id: myad.lib.php 1 9:29 2010年7月6日 $
 * @package        DedeCMS.Taglib
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
 
/*>>dede>>
<name>广告标签</name>
<type>全局标记</type>
<for>V55,V56,V57</for>
<description>获取广告代码</description>
<demo>
{dede:myad name=''/}
</demo>
<attributes>
    <iterm>typeid:投放范围,0为全站</iterm> 
    <iterm>name:广告标识</iterm>
</attributes> 
>>dede>>*/
 
require_once(DEDEINC.'/taglib/mytag.lib.php');

function lib_myad(&$ctag, &$refObj)
{
    $attlist = "typeid|0,name|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $body = lib_GetMyTagT($refObj, $typeid, $name, '#@__myad');
    
    return $body;
}