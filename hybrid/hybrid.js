(function (window) {
  "use strict";

  var HYBridApi = {
    version: 0.1
  };

  window.HYBridApi = HYBridApi;

  HYBridApi.ready = function (readyCallback) {
    console.log('test ready');
    if (readyCallback && typeof readyCallback == 'function') {
      var Api = this;
      var hyReadyFunc = function () {
        readyCallback(Api);
      };

      if (typeof window.LNJSBridge == 'undefined') {
        console.log('没有找到Bridge');
        if (document.addEventListener) {
          document.addEventListener('LNJSBridgeReady', hyReadyFunc);
        } else if (document.attachEvent) {
          document.attachEvent('LNJSBridgeReady', hyReadyFunc);
          document.attachEvent('onLNJSBridgeReady', hyReadyFunc);
        }
      } else {
        hyReadyFunc();
      }
    }
  };

})(window);
