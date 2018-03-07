import React, { Component } from 'react';
import './App.css';
import Navigation from '../NavBar/Navigation';
import { Route, Switch, BrowserRouter as Router, Link } from 'react-router-dom';
import { push } from 'history';
import HomePage from '../Home/HomePage';
import SelectLine from '../SelectLine/SelectLine';
import SelectMode from '../SelectMode/SelectMode';

class App extends Component {
  constructor(props) {
      super(props);
  }

  render() {
      return (
          <div className="App">
              <Navigation />
              <HomePage />
          </div>
    );
  }
}

export default App;
