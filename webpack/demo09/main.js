document.write('<h1>Hello World</h1>');

if (__DEV__) {
    document.write(new Date());
}

require.ensure(['./a'], function (require) {
    var content = require('./a');
    document.open();
    document.write('<h1>' + content + '</h1>');
    document.close();
});
