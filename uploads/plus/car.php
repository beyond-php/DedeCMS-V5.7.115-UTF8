<?php
/**
 *
 * 显示购物车的商品
 *
 * @version        $Id: car.php 1 20:43 2010年7月8日 $
 * @package        DedeCMS.Site
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2004 - 2024, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once (dirname(__FILE__) . "/../include/common.inc.php");
define('_PLUS_TPL_', DEDEROOT.'/templets/plus');
require_once(DEDEINC.'/dedetemplate.class.php');
require_once DEDEINC.'/shopcar.class.php';
require_once DEDEINC.'/memberlogin.class.php';
$cart = new MemberShops();

if(isset($dopost) && $dopost=='makeid')
{
    AjaxHead();
    $cart->MakeOrders();
    echo $cart->OrdersId;
    exit;
}
$cfg_ml = new MemberLogin();
//获得购物车内商品,返回数组
$Items = $cart->getItems();
if($cart->cartCount() < 1)
{
    ShowMsg("购物车中不存在任何商品！", "javascript:window.close();", false, 5000);
    exit;
}
@sort($Items);

$carts = array(
    'orders_id' => $cart->OrdersId,
    'cart_count' => $cart->cartCount(),
    'price_count' => $cart->priceCount()
);

$dtp = new DedeTemplate();
$dtp->Assign('carts',$carts);
$dtp->LoadTemplate(_PLUS_TPL_.'/car.htm');
$dtp->Display();
exit;