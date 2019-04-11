<?php

namespace app\store\controller;

//use app\store\model\Store as StoreModel;
use think\db;
/**
 * 后台首页
 * Class Index
 * @package app\store\controller
 */
class Info extends Controller
{
    /**
     * 后台首页
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model =Db::table('yoshop_use_company');

        $list = $model->alias('G')->join('yoshop_user C', 'C.user_id=G.user_id')->field('G.*,C.nickName as user')->order('G.id desc')->paginate(15, false);;


//        $list = $model->paginate(15, false);
        return $this->fetch('index', compact('list'));



//        // 当前用户菜单url
//        $menus = $this->menus();
//        $url = current(array_values($menus))['index'];
//        if ($url !== 'index/index') {
//            $this->redirect($url);
//        }
//        $model = new StoreModel;
//        return $this->fetch('index', ['data' => $model->getHomeData()]);
    }

}
