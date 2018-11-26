/**
 * ES6写法的JSBridge
 *
 * @export
 * @class JSBridge
 */
export default class JSBridge {
  constructor () {
    this.name = 'JSBridge'
    this.reset = true
  }

  /**
   * 判断设备类型
   *
   * @returns
   * @memberof JSBridge
   */
  device () {
    var u = navigator.userAgent
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1
    // eslint-disable-next-line
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/)
    return isAndroid
  }

  /**
   * JSBridge初始化
   *
   * @param {*} callback
   * @returns
   * @memberof JSBridge
   */
  _init (callback) {
    if (window.WebViewJavascriptBridge) {
      // eslint-disable-next-line
      return callback(WebViewJavascriptBridge)
    } else {
      document.addEventListener('WebViewJavascriptBridgeReady', function (WebViewJavascriptBridge) {
        return callback(WebViewJavascriptBridge)
      }, false)
    }
    if (window.WVJBCallbacks) {
      return window.WVJBCallbacks.push(callback)
    }
    window.WVJBCallbacks = [callback]
    var WVJBIframe = document.createElement('iframe')
    WVJBIframe.style.display = 'none'
    WVJBIframe.src = 'wvjbscheme://__BRIDGE_LOADED__'
    document.documentElement.appendChild(WVJBIframe)
    setTimeout(function () {
      document.documentElement.removeChild(WVJBIframe)
    }, 0)
  }

  /**
   * JSBridge 安卓初始化回调接口
   *
   * @param {*} bridge
   * @memberof JSBridge
   */
  __init__ (bridge) {
    var isAn = this.device()
    if (this.reset && isAn) {
      this.reset = false
      bridge.init(function (message, responseCallback) {
        console.log('JS got a message', message)
        var data = {
          'Javascript Responds': '测试中文!'
        }
        console.log('JS responding with', data)
        responseCallback(data)
      })
    }
  }

  /**
   * 获取用户信息
   *
   * @param {*} data
   * @param {*} callback
   * @memberof JSBridge
   */
  getUserInfo (data, callback) {
    this._init(function (bridge) {
      this.__init__(bridge)
      bridge.callHandler('getUserInfo', data, function (response) {
        if (typeof response === 'object') {
          callback(response)
        } else {
          callback(JSON.parse(response))
        }
      })
    }.bind(this))
  }

  jsEcho (callback) {
    this._init(function (bridge) {
      this.__init__(bridge)
      bridge.registerHandler('JS Echo', function (data, responseCallback) {
        console.log('JS Echo called with:', data)
        responseCallback(callback(data))
      })
    }.bind(this))
  }
}
