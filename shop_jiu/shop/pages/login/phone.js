let App = getApp();
Page({
  /**
   * 页面的初始数据
   */
  data: {
    name: '',//姓名
    phone: ''//手机号
  },
  //获取input输入框的值
  getphoneValue: function (e) {
    this.setData({
      phone: e.detail.value
    })
  },
  getpwdValue: function (e) {
    this.setData({
      pwd: e.detail.value
    })
  },

  //提交表单信息
  save: function () {
    var myreg = /^(14[0-9]|13[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$$/;
    if (this.data.phone == "") {
      wx.showToast({
        title: '手机号不能为空',
        icon: 'none',
        duration: 1000
      })
      return false;
    }
    if (this.data.pwd == "") {
      wx.showToast({
        title: '密码不能为空',
        icon: 'none',
        duration: 1000
      })
      return false;
    } else if (!myreg.test(this.data.phone)) {
      wx.showToast({
        title: '请输入正确的手机号',
        icon: 'none',
        duration: 1000
      })
      return false;
    }else{
      let _this = this;
      App._post_form('user/phone', {
        phone: _this.data.phone,
        pwd: _this.data.pwd
      }, function (result) {
        if (result.code === 1) {
        
          _this.navigateBack();
          return false;
        }
      });
    }

  },
  navigateBack: function () {
    wx.navigateTo({
      url: '../user/index'
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})
