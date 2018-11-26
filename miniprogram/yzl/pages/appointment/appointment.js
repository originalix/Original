var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var upFiles = require('../../utils/upFiles.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    buyTypeItems: [{
        name: '大众点评',
        value: '大众点评',
        checked: 'true',
      },
      {
        name: '美团',
        value: '美团',
      },
    ],
    submitTypeItems: [{
        name: 1,
        value: '手动输入',
        checked: 'true'
      },
      {
        name: 2,
        value: '上传截图',
      }
    ],
    upFilesBtn: true,
    upFilesProgress: false,
    maxUploadLen: 3,
    address: {},
    isChooseAddress: false,
    platform: '大众点评',
    enterType: 1,
    code: null,
    colthes_number: 0,
    isFinishUploaded: false,
    uploadedImgs: []
  },
  // 选择平台监听函数
  radioChange: function(e) {
    console.log('radio发生change事件，携带value值为：', e.detail)
    this.setData({
      platform: e.detail.value
    })
  },
  // 选择输入类型监听函数
  submitTypeChange: function(e) {
    console.log('radio发生change事件，携带value值为：', e.detail)
    let enterValue = parseInt(e.detail.value)
    this.setData({
      enterType: enterValue,
    })
  },
  handleInput: function (e) {
    console.log('textarea发生输入，携带value值为：', e.detail.value)
    let that = this
    this.setData({
      code: e.detail.value
    }, function () {
      console.log(that.data.code)
    })
  },
  handleCounter: function (e) {
    console.log('数字框发生改变，值为: ', e.detail.number)
    this.setData({
      clothesCount: e.detail.number
    })
  },
  // 预览图片
  previewImg: function(e) {
    let imgsrc = e.currentTarget.dataset.presrc;
    let _this = this;
    let arr = _this.data.upImgArr;
    let preArr = [];
    arr.map(function(v, i) {
      preArr.push(v.path)
    })
    //   console.log(preArr)
    wx.previewImage({
      current: imgsrc,
      urls: preArr
    })
  },
  // 删除上传图片 或者视频
  delFile: function(e) {
    let _this = this;
    wx.showModal({
      title: '提示',
      content: '您确认删除嘛？',
      success: function(res) {
        if (res.confirm) {
          let delNum = e.currentTarget.dataset.index;
          let delType = e.currentTarget.dataset.type;
          let upImgArr = _this.data.upImgArr;
          let upVideoArr = _this.data.upVideoArr;
          if (delType == 'image') {
            upImgArr.splice(delNum, 1)
            _this.setData({
              upImgArr: upImgArr,
            })
          } else if (delType == 'video') {
            upVideoArr.splice(delNum, 1)
            _this.setData({
              upVideoArr: upVideoArr,
            })
          }
          let upFilesArr = upFiles.getPathArr(_this);
          if (upFilesArr.length < _this.data.maxUploadLen) {
            _this.setData({
              upFilesBtn: true,
            })
          }
        } else if (res.cancel) {
          console.log('用户点击取消')
        }
      }
    })

  },
  // 选择图片或者视频
  uploadFiles: function(e) {
    var _this = this;
    wx.showActionSheet({
      itemList: ['选择图片'],
      success: function(res) {
        //   console.log(res.tapIndex)
        let xindex = res.tapIndex;
        if (xindex == 0) {
          upFiles.chooseImage(_this, _this.data.maxUploadLen)
        } else if (xindex == 1) {
          upFiles.chooseVideo(_this, _this.data.maxUploadLen)
        }

      },
      fail: function(res) {
        console.log(res.errMsg)
      }
    })
  },
  // 上传文件
  subFormData: function() {
    wx.showLoading({
      title: '上传图片中...'
    })
    let _this = this;
    let upData = {};
    let upImgArr = _this.data.upImgArr;
    let upVideoArr = _this.data.upVideoArr;
    _this.setData({
      upFilesProgress: true,
    })
    upData['url'] = config.service.appointmentImgAPI;
    upData['formData'] = {
    }
    upData['name'] = 'image'
    console.log(upImgArr)
    console.log(upVideoArr)
    // return
    upFiles.upFilesFun(_this, upData, function(res) {
      if (res.index < upImgArr.length) {
        upImgArr[res.index]['progress'] = res.progress

        _this.setData({
          upImgArr: upImgArr,
        })
      } else {
        let i = res.index - upImgArr.length;
        upVideoArr[i]['progress'] = res.progress
        _this.setData({
          upVideoArr: upVideoArr,
        })
      }
      //   console.log(res)
    }, function(arr) {
      wx.hideLoading()
      // success
      console.log(arr)
      console.log(upImgArr)
      if (arr === undefined || arr.length < upImgArr.length) {
        wx.showToast({
          title: '图片上传失败，请重试，或者手动输入',
          icon: 'none',
          duration: 1500
        })
      } else {
        let imgs = []
        for (var i=0; i<arr.length; i++) {
          imgs.push(arr[i].attachment.id)
        }
        console.log(imgs)
        _this.setData({
          uploadedImgs: imgs
        }, function () {
          console.log('imgs id列表', _this.data.uploadedImgs)
          // 创建团购预约
          _this.createAppointment()
        })
      }
    })
  },
  /**
   *  选择地址事件
   */
  choseAddress() {
    if (this.data.isCreatedOrder === true) {
      wx.showToast({
        title: '订单已创建，地址不能修改',
        icon: 'none',
        duration: 1500
      })
      return
    }
    console.log('choseAddress')
    var that = this
    wx.chooseAddress({
      success: function(res) {
        console.log(res)
        that.setData({
          address: res,
          isChooseAddress: true,
        }, function() {
          console.log(that.data.isChooseAddress)
        })
      },
      fail: function(res) {
        console.log(res)
        if (that.data.isChooseAddress === false) {
          that.setData({
            isChooseAddress: false,
          })
        }
      }
    })
  },
  chooseImage() {
    wx.chooseImage({
      count: 9,
      success: function(res) {
        console.log(res)
        let tempFilePaths = res.tempFilePaths
        wx.uploadFile({
          url: 'https://api.yzl1030.com/v1/image/upload',
          filePath: tempFilePaths[0],
          header: appInstance.requestToken,
          name: 'image',
          success: function(res) {
            let data = JSON.parse(res.data)
            console.log(data)
          },
          fail: function(error) {
            console.log(error)
          }
        })
      }
    })
  },
  /**
   *  创建团购预约
   */
  createAppointment () {
    let that = this
    wx.showLoading({
      title: '加载中'
    })
    let address = this.data.address
    let code = this.data.code
    let imgs = null
    if (this.data.enterType === 2) {
      code = null
      imgs = this.data.uploadedImgs
    }
    let data = {
      'platform': this.data.platform,
      'enter_type': this.data.enterType,
      'code': code,
      'clothes_count': this.data.clothesCount,
      'userName': address.userName,
      'province': address.provinceName,
      'city': address.cityName,
      'county': address.countyName,
      'street': address.detailInfo,
      'postal_code': address.postalCode,
      'tel_number': address.telNumber,
      'images_arr': imgs
    }
    console.log('请求参数: ', data);
    wx.request({
      url: config.service.appointmentCreateAPI,
      header: appInstance.requestToken,
      data: data,
      method: 'POST',
      success: function (res) {
        console.log(res)
        if (res.data.code === 200) {
          const data = res.data.data
          wx.showToast({
            title: '预约成功',
            icon: 'success',
            duration: 1500
          })
        } else {
          wx.hideLoading()
          wx.showToast({
            title: res.data.msg,
            icon: 'none',
            duration: 1500
          })
        }
      },
      fail: function (error) {
        console.log(error)
        wx.showToast({
          title: error,
          icon: 'none',
          duration: 1500
        })
      }
    })
  },
  /**
   * 上传图片函数
   */
  uploadImg () {
    if (this.checkUploadImage() === false) {
      wx.showToast({
        title: '请添加图片后继续上传',
        icon: 'none',
        duration: 1500
      })
      return
    }
    this.subFormData()
  },
  /**
   * submit之后发起的函数
   */
  createRequest() {
    if (this.data.enterType === 1) {
      this.createAppointment()
    } else {
      this.uploadImg()
    }
  },
  /**
   *  判断请求是否能进行下去
   */
  checkUploadImage () {
    if (this.data.enterType !== 2) {
      return true;
    } 

    let upImgArr = this.data.upImgArr;
    if (upImgArr === undefined) {
      return false
    }

    if (upImgArr.length < 1) {
      return false
    }

    return true
  }
})

