import React, { Component } from 'react';
import './App.css';
import Navigation from '../NavBar/Navigation';
import HomePage from '../Home/HomePage';
import SelectLine from '../SelectLine/SelectLine';

class App extends Component {
  render() {
    return (
      <div className="App">
        <Navigation />
        {/* <SelectLine /> */}
        {/* <HomePage /> */}
      </div>
    );
  }
}

export default App;
