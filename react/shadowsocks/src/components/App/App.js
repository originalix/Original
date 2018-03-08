import React, {Component} from 'react';
import './App.css';
import Navigation from '../NavBar/Navigation';
import HomePage from '../Home/HomePage';

class App extends Component {
  render() {
    return (
      <div className="App">
        <Navigation/>
        <HomePage/>
      </div>
    );
  }
}

export default App;
