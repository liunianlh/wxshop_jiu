<?php

namespace app\api\controller;

use app\api\model\UserAddress;

/**
 * 收货地址管理
 * Class Address
 * @package app\api\controller
 */
class Address extends Controller
{
    /**
     * 收货地址列表
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function lists()
    {
        $user = $this->getUser();
        $model = new UserAddress;
        $list = $model->getList($user['user_id']);
        return $this->renderSuccess([
            'list' => $list,
            'default_id' => $user['address_id'],
        ]);
    }

    /**
     * 添加收货地址
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function add()
    {
        $model = new UserAddress;
        $model->add($this->getUser(), $this->request->post());

        if ($model->add($this->getUser(), $this->request->post())) {
            return $this->renderSuccess([], '添加成功');
        }
        return $this->renderError('添加失败');
    }

//    添加公司地址
    public function company(){
        $model=Db::table('yoshop_use_company');
        $list=$this->request->post();
        $info["company"]=$list["company"];
        $info["address"]=$list["address"];
        $info["contacts"]=$list["contacts"];
        $info["phone"]=$list["phone"];
        $info["duty"]=$list["duty"];
        $info["opening"]=$list["opening"];
        $info["number"]=$list["number"];
        $info["wxapp_id"]=$list["wxapp_id"];
        $user_id=$this->getUser();
        $info["user_id"]=$user_id["user_id"];
        if ($model->insert($info)) {
            return $this->renderSuccess([], '添加成功');
        }
        return $this->renderError('添加失败');
    }


    /**
     * 收货地址详情
     * @param $address_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function detail($address_id)
    {
        $user = $this->getUser();
        $detail = UserAddress::detail($user['user_id'],$address_id);
        $region = array_values($detail['region']);
        return $this->renderSuccess(compact('detail', 'region'));
    }

    /**
     * 编辑收货地址
     * @param $address_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function edit($address_id)
    {
        $user = $this->getUser();
        $model = UserAddress::detail($user['user_id'], $address_id);
        if ($model->edit($this->request->post())) {
            return $this->renderSuccess([], '更新成功');
        }
        return $this->renderError('更新失败');
    }

    /**
     * 设为默认地址
     * @param $address_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function setDefault($address_id) {
        $user = $this->getUser();
        $model = UserAddress::detail($user['user_id'], $address_id);
        if ($model->setDefault($user)) {
            return $this->renderSuccess([], '设置成功');
        }
        return $this->renderError('设置失败');
    }

    /**
     * 删除收货地址
     * @param $address_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function delete($address_id)
    {
        $user = $this->getUser();
        $model = UserAddress::detail($user['user_id'], $address_id);
        if ($model->remove($user)) {
            return $this->renderSuccess([], '删除成功');
        }
        return $this->renderError('删除失败');
    }

}
