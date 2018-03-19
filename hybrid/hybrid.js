window.HybridAPI = (function () {
  var events = {};
  var asynchronous = false;
  var isReady = false;
  var lastShareAction;
  var hyData;
  
  function hello(success, failed) {
    console.log('Hello world');
    if (success) {
      success();
    }
    return self;
  }

  return {
    hello: hello,
  }
}());
