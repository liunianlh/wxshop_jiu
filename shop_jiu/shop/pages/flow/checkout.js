let App = getApp();

Page({

  /**
   * 页面的初始数据
   */
  data: {
    // 快捷导航
    nav_select: false,

    // 当前页面参数
    options: {},

    address: null, // 默认收货地址
    exist_address: false, // 是否存在收货地址
    goods: {}, // 商品信息

    // 选择的优惠券
    selectCoupon: {
      index: null,
      couponId: null,
      reduced_price: '0.00'
    },

    // 买家留言
    remark: '',

    // 禁用submit按钮
    disabled: false,

    hasError: false,
    error: '',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {
    // 当前页面参数
    this.data.options = options;
    console.log(options);
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function() {
    // 获取当前订单信息
    this.getOrderData();
  },

  /**
   * 获取当前订单信息
   */
  getOrderData: function() {
    let _this = this,
      options = _this.data.options;

    // 获取订单信息回调方法
    let callback = function(result) {
      if (result.code !== 1) {
        App.showError(result.msg);
        return false;
      }
      // 显示错误信息
      if (result.data.has_error) {
        _this.data.hasError = true;
        _this.data.error = result.data.error_msg;
        App.showError(_this.data.error);
      }
      _this.setData(result.data);
    };

    // 立即购买
    if (options.order_type === 'buyNow') {
      App._get('order/buyNow', {
        goods_id: options.goods_id,
        goods_num: options.goods_num,
        goods_sku_id: options.goods_sku_id
      }, function(result) {
        callback(result);
      });
    }

    // 购物车结算
    else if (options.order_type === 'cart') {
      App._get('order/cart', {
        cart_ids: options.cart_ids
      }, function(result) {
        callback(result);
      });
    }

  },

  /**
   * 选择收货地址
   */
  selectAddress: function() {
    wx.navigateTo({
      url: '../address/' + (this.data.exist_address ? 'index?from=flow' : 'create')
    });
  },

  /**
   * 订单提交
   */
  submitOrder: function() {
    let _this = this,
      options = _this.data.options;

    if (_this.data.disabled) {
      return false;
    }

    if (_this.data.hasError) {
      App.showError(_this.data.error);
      return false;
    }

    // 订单创建成功后回调--微信支付
    let callback = function(result) {
      if (result.code === -10) {
        App.showError(result.msg, function() {
          // 跳转到未付款订单
          wx.redirectTo({
            url: '../order/index',
          });
        });
        return false;
      }
      // 发起微信支付
      wx.requestPayment({
        timeStamp: result.data.payment.timeStamp,
        nonceStr: result.data.payment.nonceStr,
        package: 'prepay_id=' + result.data.payment.prepay_id,
        signType: 'MD5',
        paySign: result.data.payment.paySign,
        success: function(res) {
          // 跳转到订单详情
          wx.redirectTo({
            url: '../order/detail?order_id=' + result.data.order_id,
          });
        },
        fail: function() {
          App.showError('订单未支付', function() {
            // 跳转到未付款订单
            wx.redirectTo({
              url: '../order/index',
            });
          });
        },
      });
    };

    // 按钮禁用, 防止二次提交
    _this.data.disabled = true;

    // 显示loading
    wx.showLoading({
      title: '正在处理...'
    });

    // 创建订单-立即购买
    if (options.order_type === 'buyNow') {
      App._post_form('order/buyNow', {
        goods_id: options.goods_id,
        goods_num: options.goods_num,
        goods_sku_id: options.goods_sku_id,
        coupon_id: _this.data.selectCoupon.couponId,
        remark: _this.data.remark
      }, function(result) {
        // success
        console.log('success');
        callback(result);
      }, function(result) {
        // fail
        console.log('fail');
      }, function() {
        // complete
        console.log('complete');
        wx.hideLoading();
        // 解除按钮禁用
        _this.data.disabled = false;
      });
    }

    // 创建订单-购物车结算
    else if (options.order_type === 'cart') {
      App._post_form('order/cart', {
        cart_ids: options.cart_ids,
        coupon_id: _this.data.selectCoupon.couponId,
        remark: _this.data.remark
      }, function(result) {
        // success
        console.log('success');
        callback(result);
      }, function(result) {
        // fail
        console.log('fail');
      }, function() {
        // complete
        console.log('complete');
        wx.hideLoading();
        // 解除按钮禁用
        _this.data.disabled = false;
      });
    }

  },

  /**
   * 买家留言
   */
  bindRemark: function(e) {
    this.setData({
      remark: e.detail.value
    })
  },

  /**
   * 快捷导航 显示/隐藏
   */
  commonNav: function() {
    this.setData({
      nav_select: !this.data.nav_select
    });
  },

  /**
   * 快捷导航跳转
   */
  nav: function(e) {
    let url = '';
    switch (e.currentTarget.dataset.index) {
      case 'home':
        url = '../index/index';
        break;
      case 'fenlei':
        url = '../category/index';
        break;
      case 'cart':
        url = '../flow/index';
        break;
      case 'profile':
        url = '../user/index';
        break;
    }
    wx.switchTab({
      url
    });
  },

  /**
   * 选择优惠券(弹出/隐藏)
   */
  togglePopupCoupon() {
    if (this.data.coupon_list.length > 0) {
      this.setData({
        showBottomPopup: !this.data.showBottomPopup
      });
    }
  },

  /**
   * 选择优惠券
   */
  selectCouponTap: function(e) {
    let dataset = e.currentTarget.dataset;
    // 优惠券折扣金额
    let reducedPrice = this.data.coupon_list[dataset.index].reduced_price;
    dataset.reduced_price = reducedPrice;
    // 计算优惠后的价格
    let actualPayPrice = this.bcsub(this.data.order_pay_price, reducedPrice);
    this.setData({
      selectCoupon: dataset,
      actual_pay_price: actualPayPrice > 0 ? actualPayPrice : '0.01'
    });
    this.togglePopupCoupon();
  },

  /**
   * 不使用优惠券
   */
  doNotCouponTap: function() {
    this.setData({
      selectCoupon: {},
      actual_pay_price: this.data.order_pay_price
    });
    this.togglePopupCoupon();
  },

  /**
   * 数学运算相减
   */
  bcsub: function(arg1, arg2) {
    return (Number(arg1) - Number(arg2)).toFixed(2);
  },


});