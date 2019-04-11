<?php

namespace app\api\controller;

use app\api\model\WxappPage;

/**
 * 页面控制器
 * Class Index
 * @package app\api\controller
 */
class Page extends Controller
{
    /**
     * 首页diy数据
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function home()
    {
        // 页面元素
        $items = WxappPage::getPageItems($this->getUser(false));
        return $this->renderSuccess(compact('items'));
    }

    //   总
    public function homeapp()
    {
        $items = WxappPage::getPageItems($this->getUser(false));
        return print_r($items);
    }

//    轮播图
    public function homeimg()
    {
        $items = WxappPage::getPageItems($this->getUser(false));
        $data=$items["n8106185291409505"]["data"];
    }

//    优惠券
    public function homequan()
    {
        $items = WxappPage::getPageItems($this->getUser(false));
        $data=$items["n7774179531489054"]["data"];
     return print_r($data);
    }

    //    公告
    public function homegg()
    {
        $items = WxappPage::getPageItems($this->getUser(false));
        $data=$items["n51649760681652"]["params"];
        return print_r($data);
    }

    //    商品
    public function homeshop()
    {
        $items = WxappPage::getPageItems($this->getUser(false));
        $data=$items["n259350248928931"]["data"];
        return var_dump($data);
    }

    /**
     * 自定义页数据
     * @param $page_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function custom($page_id)
    {
        // 页面元素
        $items = WxappPage::getPageItems($this->getUser(false), $page_id);
        return $this->renderSuccess(compact('items'));
    }

}
