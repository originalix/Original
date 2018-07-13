/**
 * 基于vue-cli的spa
 */

import JSBridge from './JSBridge';
let Plugins = {};
let MyJSBridge = new JSBridge();

Plugins.install = function (Vue) {
    Vue.GetUserInfo = Vue.prototype.$GetUserInfo = function () {
        return new Promise((resolve, reject) => {
            if (process.env.NODE_ENV === 'production') {
                //生产环境调用JSBridge
                MyJSBridge.getUserInfo({}, function (res) {
                    resolve(res)
                })
            } else {
                //开发环境调试代码
            }
        })
    }
};

export default Plugins;

