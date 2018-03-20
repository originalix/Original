(function (window) {
  "use strict";

  var HYBridApi = {
    version: 0.1
  };

  window.HYBridApi = HYBridApi;
  window.dsbridge = bridge;
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
    console.log(bridge);
    var str = bridge.call("testParams", {'data': 1, 'name': 'Lix'});
    console.log(str);
  };

  var _share = function (cmd, data, callbacks) {
    callbacks = callbacks || {};
    
    var progress = function (resp) {
      switch (true) {
        // 用户取消
        case /\:cancel$/i.test(resp.err_msg) :
          callbacks.cancel && callbacks.cancel(resp);
        break;
        // 发送成功
        case /\:(confirm|ok)$/i.test(resp.err_msg):
          callbacks.confirm && callbacks.confirm(resp);
        break;
        // fail　发送失败
        case /\:fail$/i.test(resp.err_msg) :
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
          // 分享到朋友圈
        } else if (argv.shareTo === 'friend') {
          // 分享到微信
        } else if (argv.shareTo === 'QQ ') {
          // 分享到QQ
        } else if (argv.shareTo === 'weibo') {
          // 分享到微博
        }
      }
    };

    handler(data, data.action);
  }

  HYBridApi.shareToTimeline = function (data, callbacks) {
    _share({
      menu: 'menu:share:timeline',
      action: 'shareTimeline'
    }, {
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
