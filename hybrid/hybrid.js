window.HybridAPI = (function () {
  var events = {};
  var asynchronous = false;
  var isReady = false;
  var lastShareAction;
  var hyData;
  
  function ready(data, callback) {
    var self = this;
    if (!isReady) {
      var _hybridBridgeReady = function () {
        hybridBridgeReady(self, callback);
      }
      hyData = data || {};
      if ('addEventListener' in document) {
        document.addEventListener('HYBridBridge', _hybridBridgeReady, false);
      } else if (document.attachEvent) {
        console.log('attachEvent');
      }
    } else if (callback) {
      callback.call(null, self);
    }

    return self;
  }

  function hybridBridgeReady(context, callback) {
    isReady = true;
    if (callback) {
      alert(callback);
    }
  }

  return {
    hello: hello,
  }
}());
