(function (window) {
  "use strict";

  var HYBridApi = {
    version: 0.1
  };

  window.HYBridApi = HYBridApi;
  window.JSBridge = bridge;
  console.log(window.dsbridge);
  
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

  var _share = function (cmd, data, callbacks) {
    callbacks = callbacks || {};
    
    var progress = function (resp) {
      switch (true) {
        // 用户取消
        case /cancel$/.test(resp) :
          callbacks.cancel && callbacks.cancel(resp);
        break;
        // 发送成功
        case /confirm$/.test(resp):
          callbacks.confirm && callbacks.confirm(resp);
        break;
        // fail　发送失败
        case /fail$/.test(resp) :
        default:
          callbacks.fail && callbacks.fail(resp);
        break;
      }
      // 无论成功失败都会执行的回调
      callbacks.all && callbacks.all(resp);
    };

    var handler = function (theData, argv) {
      
      if (cmd.menu === 'general:share') {
        if (argv.shareTo === 'timeline') {
          // 分享到朋友圈);
        } else if (argv.shareTo === 'friend') {
          // 分享到微信
        } else if (argv.shareTo === 'QQ ') {
          // 分享到QQ
        } else if (argv.shareTo === 'weibo') {
          // 分享到微博
        }
      } else {
        _nativeShare(cmd.action, theData, progress);
      }
    };

    handler(data, data.action);
  }

  var _nativeShare = function (action, data, progress) {
    JSBridge.call('share.' + action, data, function (res) {
      progress(res);
    });
  }

  HYBridApi.shareToTimeline = function (data, callbacks) {
    _share({
      menu: 'menu:share:timeline',
      action: 'shareTimeline'
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
})(window);
