document.write('<h1>Hello World</h1>');

if (__DEV__) {
    document.write(new Date());
}

/**
 * Code splitting 
 */

// require.ensure(['./a'], function (require) {
//     var content = require('./a');
//     document.open();
//     document.write('<h1>' + content + '</h1>');
//     document.close();
// });

/**
 * Code Splitting with bundle-loader
 */
var load = require('bundle-loader!./a.js');
load(function(file)  {
    document.open();
    document.write('<h1>' + file + '</h1>');
    document.close();
});
