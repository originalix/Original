import React, { Component } from 'react';
import './App.css';
import Navigation from '../NavBar/Navigation';
import HomePage from '../Home/HomePage';
import SelectLine from '../SelectLine/SelectLine';

import { Link } from 'react-router-dom';

class App extends Component {
  render() {
    return (
      <div className="App">
        <Navigation />

        <ul role="nav">
            <li><Link to="/home">Home</Link></li>
            <li><Link to="/select">About</Link></li>
        </ul>
        
        {this.props.children}
      </div>
    );
  }
}

export default App;
