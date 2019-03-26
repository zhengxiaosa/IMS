<?php
namespace app\api;
/**
 * Created by PhpStorm.
 * User: 36934
 * Date: 2019/3/26
 * Time: 22:33
 */
class index
{
    public function index(){
        require_once APP_PATH.'api/wxpay/lib/WxPay.Api.php';
        $input = new\unifiedOrder();
        //设置商品描述
        $input->SetBody('测试商品');
        //设置订单号
        $input->SetOut_trade_no(date('Ymdhis'));
        //设置订单金额
        $input->SetTotal_fee('1');
        //设置异步通知地址
        $input->SetNotify_url('http://www.php.wx/index.php/index/Notify/index');
        //设置交易类型
        $input->SetTrade_type('NATIVE');
        //设置商品ID
        $input->SetProduct_id('123456789');
        //调用统一下单API
        $result = \WxPayAPI::unifiedOrder($input);
        $code_url = $result['code_url'];
        $img = '<img src=http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($code_url).'/>';
        echo $img;
    }
}