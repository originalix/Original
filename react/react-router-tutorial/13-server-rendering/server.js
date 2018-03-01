import React from 'react';
import { renderToString } from 'react-dom/server';
import { match, RouterContext } from 'react-router';
import routes from './modules/routes';

var express = require('express');
var path = require('path');
var compression = require('compression');

var app = express();

app.use(compression())

app.use(express.static(path.join(__dirname, 'public')));

app.get('*', (req, res) => {
    match({ routes: routes, location: req.url }, (err, redirect, props) => {
        const appHtml = renderToString(<RouterContext {...props}/>);
        res.send(renderPage(appHtml));
    });
});

function renderPage(appHtml) {
    return `
    <!DOCTYPE html public="storage">
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Lix's first react-router</title>
    </head>
    <body>
        <div id="app">${appHtml}</div>
        <script scr="/bundle.js"></script>
    </body>
    `
}

app.get('*', function (req, res) {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

var PORT = process.env.PORT || 8080;
app.listen(PORT, function () {
    console.log('Production Express server running at localhost:' + PORT);
});
