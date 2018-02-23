var express = require('express');
var app = express();

var router = express.Router();

router.get('/', function(req, res) {
    res.send('<h1>Hello world</h1>');
});

// app.use('/home', router);
app.use('/', router);
app.use('/home', router);

var port = process.env.PORT || 8080;

app.listen(port);
console.log('Magic happens on port ' + port);
