/** 
 * Demo03: Babel-loader 
 * */
const React = require('react');
const ReactDOM = require('react-dom');

ReactDOM.render(
    <h1>Hello React!</h1>,
    document.querySelector('#wrapper')
);

/**
 * Demo04: CSS-loader
 */
require('./app.css');

/**
 * Demo05: Image loader 
 */
var img1 = document.createElement("img");
img1.src = require("./small.png");
document.body.appendChild(img1);

var img2 = document.createElement("img");
img2.src = require("./big.png");
document.body.appendChild(img2);
