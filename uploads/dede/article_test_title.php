<?php
/**
 * 检测重复文档
 *
 * @version        $Id: article_test_same.php 1 14:31 2010年7月12日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
AjaxHead();

$_SESSION['photo_watertext'] = $t;

unset($_SESSION['needwatermarkup']);
unset($_SESSION['_needwatermarkup']);
unset($_SESSION['needwatermarkdown']);
if (!empty($needwatermarkup) && !empty($needwatermarkdown)) {
    $_SESSION['needwatermarkup'] = $needwatermarkup == 'true' ? '1' : '0';
    $_SESSION['_needwatermarkup'] = $_SESSION['needwatermarkup'];
    $_SESSION['needwatermarkdown'] = $needwatermarkdown == 'true' ? '1' : '0';
}

if(empty($t) || $cfg_check_title=='N') exit;

$row = $dsql->GetOne("SELECT `id` FROM `#@__archives` WHERE `title` LIKE '{$t}' AND `id` != '{$aid}'");
if(is_array($row))
{
    echo "提示：系统已经存在标题为 '<a href='../plus/view.php?aid={$row['id']}' style='color:red' target='_blank'><u>$t</u></a>' 的文档。[<a href='#' onclick='javascript:HideObj(\"mytitle\")'>关闭</a>]";
}