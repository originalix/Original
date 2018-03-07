import React, { Component } from 'react';
import logo from '../../logo.svg';
import './App.css';
import Navigation from '../NavBar/Navigation';

class App extends Component {
  render() {
    return (
      <div className="App">
        <Navigation />
      </div>
    );
  }
}

export default App;
