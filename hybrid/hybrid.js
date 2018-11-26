(function (window) {
  "use strict";

  var HYBridApi = {
    version: 0.1
  };

  window.HYBridApi = HYBridApi;
  window.JSBridge = bridge;
  console.log(window.bridge);
  
  /**
   * 检测JS与Native是否完成桥接
   * @param {*} readyCallback 实例回调，可用于直接操作剩余API
   */
  HYBridApi.ready = function (readyCallback) {
    console.log('test ready');
    if (readyCallback && typeof readyCallback == 'function') {
      var Api = this;
      var hyReadyFunc = function () {
        readyCallback(Api);
      };

      hyReadyFunc();
    }
  };

  HYBridApi.test = function () {
    console.log(JSBridge);
    var str = JSBridge.call("testParams", {'data': 1, 'name': 'Lix'});
    console.log(str);
  };

  /**
   * 私有方法：分享
   * @param {*} cmd 
   * @param {*} data 分享数据
   * @param {*} callbacks 分享回调
   */
  var _share = function (cmd, data, callbacks) {
    callbacks = callbacks || {};
    
    var progress = function (resp) {
      switch (true) {
        // 用户取消
        case /cancel$/.test(resp.state) :
          callbacks.cancel && callbacks.cancel(resp);
        break;
        // 发送成功
        case /confirm$/.test(resp.state):
          callbacks.confirm && callbacks.confirm(resp);
        break;
        // fail　发送失败
        case /fail$/.test(resp.state) :
        default:
          callbacks.fail && callbacks.fail(resp);
        break;
      }
      // 无论成功失败都会执行的回调
      callbacks.all && callbacks.all(resp);
    };

    var handler = function (theData, argv) {
      _nativeShare(cmd.action, theData, progress);
    };

    handler(data, data.action);
  }

  /**
   * 调起原生分享的桥接方法
   * @param {*} action 分享类型
   * @param {*} data 分享数据
   * @param {*} progress 分享进度回调
   */
  var _nativeShare = function (action, data, progress) {
    JSBridge.call(action, data, function (res) {
      progress(res);
    });
  }

  /**
   * 分享至微信朋友圈
   * @param {*} data 发送分享数据
   * @param {*} callbacks 分享回调  
   */
  HYBridApi.shareToTimeline = function (data, callbacks) {
    _share({
      menu: 'menu:share:timeline',
      action: 'shareToTimeline'
    }, {
      "state": 0,
      "appid": data.appId ? data.appId : '',
      "img_url": data.imgUrl,
      "link": data.link,
      "desc": data.desc,
      "title": data.title,
      "img_width": "640",
      "img_height": "640"      
    }, callbacks);
  };

  /**
   * 分享至微信好友
   * @param {*} data 发送分享数据
   * @param {*} callbacks 分享回调
   */
  HYBridApi.shareToFriend = function (data, callbacks) {
    _share({
      menu: 'menu:share:friend',
      action: 'shareToFriend'
    }, {
      "state": 0,
      "appid": data.appId ? data.appId : '',
      "img_url": data.imgUrl,
      "link": data.link,
      "desc": data.desc,
      "title": data.title,
      "img_width": "640",
      "img_height": "640"      
    }, callbacks);
  };

  /**
   * 分享至新浪微博
   * @param {*} data 发送分享数据
   * @param {*} callbacks 分享回调
   */
  HYBridApi.shareToSinaWeibo = function (data, callbacks) {
    _share({
      menu: 'menu:share:sinaweibo',
      action: 'shareToSinaWeibo'
    }, {
      "state": 0,
      "appid": data.appId ? data.appId : '',
      "img_url": data.imgUrl,
      "link": data.link,
      "desc": data.desc,
      "title": data.title,
      "img_width": "640",
      "img_height": "640"      
    }, callbacks);
  };

  /**
   * 分享至QQ好友
   * @param {*} data 发送分享数据
   * @param {*} callbacks 分享回调
   */
  HYBridApi.shareToQQ = function (data, callbacks) {
    _share({
      menu: 'menu:share:qq',
      action: 'shareToQQ'
    }, {
      "state": 0,
      "appid": data.appId ? data.appId : '',
      "img_url": data.imgUrl,
      "link": data.link,
      "desc": data.desc,
      "title": data.title,
      "img_width": "640",
      "img_height": "640"      
    }, callbacks);
  };

  /**
   * 分享至QQ空间
   * @param {*} data 发送分享数据
   * @param {*} callbacks 分享回调
   */
  HYBridApi.shareToQZone = function (data, callbacks) {
    _share({
      menu: 'menu:share:qzone',
      action: 'shareToQZone'
    }, {
      "state": 0,
      "appid": data.appId ? data.appId : '',
      "img_url": data.imgUrl,
      "link": data.link,
      "desc": data.desc,
      "title": data.title,
      "img_width": "640",
      "img_height": "640"      
    }, callbacks);
  };

  /** 
   *  JS-API 选择图片的缓存数组
   */ 
  HYBridApi.imgSrcList = [];

  /**
   * 调起Native端的选择图片功能
   */
  HYBridApi.chooseImage = function () {
    JSBridge.call('chooseImage', function (res) {
      HYBridApi.imgSrcList = res.srcList;
      console.log(HYBridApi.imgSrcList);
    });
  };

  /**
   * 调起Native端的图片浏览框架
   * @param {*} curSrc 当前图片url
   * @param {*} srcList 图片列表
   */
  HYBridApi.previewImage = function (curSrc, srcList) {
    if (!curSrc || !srcList || srcList.length == 0) {
      alert('请先选择图片之后再调用浏览功能');
      return;
    }

    JSBridge.call('previewImage', {
      'current': curSrc,
      'urls': srcList
    });
  };

  /**
   * JS-API上传图片功能
   * @param {*} srcList 上传图片列表 
   * @param {*} callbacks 各种状态的回调,详情见示例
   */
  HYBridApi.uploadImage = function (srcList, callbacks) {
    if (!srcList || srcList.length == 0) {
      alert('请先选择照片之后再上传');
      return;
    }

    var progress = function (resp) {
      switch (true) {
        // 用户进度
        case /continue$/.test(resp.state):
          callbacks.continue && callbacks.continue(resp.count);
        break;
        // 用户取消
        case /cancel$/.test(resp.state) :
          callbacks.cancel && callbacks.cancel();
        break;
        // 发送成功
        case /confirm$/.test(resp.state):
          callbacks.confirm && callbacks.confirm();
        break;
        // fail　发送失败
        case /fail$/.test(resp.state) :
        default:
          callbacks.fail && callbacks.fail(resp);
        break;
      }
      // 无论成功失败都会执行的回调
      callbacks.all && callbacks.all(resp);
    };

    JSBridge.call('uploadImage', {
      "urls": srcList,
    }, function (res) {
      progress(res);
    });
  };

  /**
   * 获取网络状态
   */
  HYBridApi.getNetworkType = function () {
    var type = JSBridge.call('getNetworkType');
    return type;
  }

  /**
   * 监听网络变化API
   * @param {*} callback 回调
   */
  HYBridApi.receiverNetworkType = function (callback) {
    JSBridge.register('receiverNetworkType', function (type) {
      callback && callback(type);
    });
  }

  /**
   * 获取当前地理位置
   * @param {*} callback 地理位置信息回调
   */
  HYBridApi.getLocation = function (callback) {
    JSBridge.call('getLocation', function (res) {
      callback(res);
    });
  }

  /**
   * 关闭当前网页窗口
   */
  HYBridApi.closeWindow = function () {
    JSBridge.call('closeWindow');
  }

  /**
   * 接管返回按钮设置
   * @param {*} isTakeOver 是否接管原生返回按钮
   * @param {*} callback 执行回调
   */
  HYBridApi.takeOverBackBtn = function (isTakeOver, callback) {
    var jscode = ''
    if (isTakeOver === true) {
      jscode = 'window.history.back()'
    }
    var data = {
      'jscode': jscode,
      'isTakeOver': isTakeOver,
    }
    JSBridge.call('takeOverBackBtn', data, function (res) {
      callback(res);
    });
  }

  /**
   * 直接返回二维码结果
   * @param {*} callback 二维码结果回调
   */
  HYBridApi.scanQRCode = function (callback) {
    JSBridge.call('scanQRCode', function (res) {
      callback(res.result);
    });
  }

  /**
   * 发起一个微信支付的请求
   * @param {*} data 微信支付所需数据
   * @param {*} callbacks 支付过程所有回调
   */
  HYBridApi.chooseWXPay = function (data, callbacks) {
    var progress = function (resp) {
      switch (true) {
        // 用户取消支付
        case /cancel$/.test(resp.state) :
          callbacks.cancel && callbacks.cancel();
        break;
        // 支付成功
        case /confirm$/.test(resp.state):
          callbacks.confirm && callbacks.confirm();
        break;
        // fail　支付失败
        case /fail$/.test(resp.state) :
        default:
          callbacks.fail && callbacks.fail(resp);
        break;
      }
      // 无论成功失败都会执行的回调
      callbacks.all && callbacks.all(resp);
    };

    JSBridge.call('chooseWXPay', {
      'partnerId': data.partnerId,
      'prepayId': data.prepayId,
      'package': data.package,
      'nonceStr': data.nonceStr,
      'timeStamp': data.timeStamp,
      'sign': data.sign
    }, function (res) {
      console.log(res);
      progress(res);
    });
  }

  /**
   * 发起一个支付宝的请求
   * @param {*} data 支付宝支付所需数据
   * @param {*} callbacks 支付过程所有回调
   */
  HYBridApi.chooseAliPay = function (data, callbacks) {
    var progress = function (resp) {
      switch (true) {
        // 用户取消支付
        case /cancel$/.test(resp.state) :
          callbacks.cancel && callbacks.cancel();
        break;
        // 支付成功
        case /confirm$/.test(resp.state):
          callbacks.confirm && callbacks.confirm();
        break;
        // fail　支付失败
        case /fail$/.test(resp.state) :
        default:
          callbacks.fail && callbacks.fail(resp);
        break;
      }
      // 无论成功失败都会执行的回调
      callbacks.all && callbacks.all(resp);
    };

    JSBridge.call('chooseAliPay', {
      'orderStr': data.orderStr,
    }, function (res) {
      console.log(res);
      progress(res);
    });
  }

  HYBridApi.androidTest = function(callback) {
    JSBridge.call('androidTest', {'name': 'Android'}, function (res) {
      // alert(JSON.parse(res));
      callback(res);
      // alert(res);
      // alert(JSON.stringify(res));
      // alert(JSON.parse(res));
      // alert('Hello world');
    });
  }

})(window);
