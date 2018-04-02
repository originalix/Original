import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import 'whatwg-fetch';

class App extends Component {
  render() {
    fetch('http://localhost/code-repo/PHP/wxdev/web/image/upload')
      .then(function(response) {
        return response.json();
      }).then(function (body) {
        console.log('parsed json', json);
      }).catch(function(ex) {
        console.log('parsing failed', ex);
      })
    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <h1 className="App-title">Welcome to React</h1>
        </header>
        <p className="App-intro">
          To get started, edit <code>src/App.js</code> and save to reload.
        </p>
      </div>
    );
  }
}

export default App;
