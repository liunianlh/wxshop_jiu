<?php

namespace app\common\model;

/**
 * 微信小程序diy页面模型
 * Class WxappPage
 * @package app\common\model
 */
class WxappPage extends BaseModel
{
    protected $name = 'wxapp_page';

    /**
     * 格式化页面数据
     * @param $json
     * @return array
     */
    public function getPageDataAttr($json)
    {
        $array = json_decode($json, true);
        return compact('array', 'json');
    }

    /**
     * 自动转换data为json格式
     * @param $value
     * @return string
     */
    public function setPageDataAttr($value)
    {
        return json_encode($value ?: ['items' => []]);
    }

    /**
     * diy页面详情
     * @param int $page_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($page_id)
    {
        return self::get(['page_id' => $page_id]);
    }

    /**
     * diy页面详情
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function getHomePage()
    {
        return self::get(['page_type' => 10]);
    }
}
