;
(function(global) {
    function JSBridge() {
        this.name = 'JSBridge';
        this.reset = true;
    };

    JSBridge.prototype.device = function() {
        var u = navigator.userAgent;
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
        return isAndroid;
    };
    /**
     * @param null
     * JSBridge初始化
     */
    JSBridge.prototype._init = function(callback) {
        if (window.WebViewJavascriptBridge) {
            return callback(WebViewJavascriptBridge);
        } else {
            document.addEventListener('WebViewJavascriptBridgeReady', function(WebViewJavascriptBridge) {
                return callback(WebViewJavascriptBridge);
            }, false);
        }
        if (window.WVJBCallbacks) { return window.WVJBCallbacks.push(callback); }
        window.WVJBCallbacks = [callback];
        var WVJBIframe = document.createElement('iframe');
        WVJBIframe.style.display = 'none';
        WVJBIframe.src = 'wvjbscheme://__BRIDGE_LOADED__';
        document.documentElement.appendChild(WVJBIframe);
        setTimeout(function() { document.documentElement.removeChild(WVJBIframe) }, 0)
    };
    /**
     * @param null
     * JSBridge 安卓初始化回调接口
     */
    JSBridge.prototype.__init__ = function(bridge) {
        var isAn = this.device();
        if (this.reset && isAn) {
            this.reset = false;
            bridge.init(function(message, responseCallback) {
                console.log('JS got a message', message);
                var data = {
                    'Javascript Responds': '测试中文!'
                };
                console.log('JS responding with', data);
                responseCallback(data);
            });
        }
    };


    /**
     * @param data-> null
     * 获取用户信息   返回用户信息 token ，refreshToken 等等
     */
    JSBridge.prototype.getUserInfo = function(data, callback) {
        this._init(function(bridge) {
            this.__init__(bridge);
            bridge.callHandler('getUserInfo', data, function(response) {
                if(typeof response === 'object'){
                    callback(response)
                }else{
                    callback(JSON.parse(response));
                }
            })
        }.bind(this))
    };

    /**
     * native调用javascript的函数
     * @param {*} callback 被原生调用后执行的函数
     */
    JSBridge.prototype.jsEcho = function(callback) {
        this._init(function(bridge) {
            this.__init__(bridge);
            bridge.registerHandler('JS Echo', function(data, responseCallback) {
                console.log("JS Echo called with:", data)
                responseCallback(callback(data))
            })
        }.bind(this))
    }

    /**
     * 根据自己需求添加方法
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     */

    if (typeof module !== 'undefined' && module.exports) {
        module.exports = JSBridge;
    } else if (typeof define === 'function' && (define.amd || define.cmd)) {
        define(function() {
            return JSBridge;
        });
    } else {
        global.JSBridge = JSBridge;
    };
    
})(this);