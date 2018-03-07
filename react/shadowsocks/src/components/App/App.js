import React, { Component } from 'react';
import logo from '../../logo.svg';
import './App.css';
import Navigation from '../NavBar/Navigation';
import ConnectView from '../ConnectView/ConnectView';

class App extends Component {
  render() {
    return (
      <div className="App">
        <Navigation />
        <ConnectView />
      </div>
    );
  }
}

export default App;
