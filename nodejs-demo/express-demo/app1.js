var express = require('express');
var app = express();

var router = express.Router();

router.get('/', function(req, res) {
    res.send('<h1>Hello world</h1>');
});

app.use('/home', router);