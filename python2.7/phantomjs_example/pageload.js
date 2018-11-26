var page = require('webpage').create();
page.viewportSize = { width : 750, height: 1334 };
page.clipRect = { top: 0, left: 0, width: 750, height: 1334};
page.open('http://baidu.com', function(status) {
    console.log('Status: ' + status);
    if (status === "success") {
        page.render('example.png');
    }
    phantom.exit();
});
