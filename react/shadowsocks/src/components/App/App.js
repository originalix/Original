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
      this.pushToSetting = this.pushToSetting.bind(this);
      this.pushToSelectMode = this.pushToSelectMode.bind(this);
  }

  pushToSetting() {
      this.props.history.push('/select');
  }

  pushToSelectMode() {
      this.props.history.push('/selectmode');
  }

  render() {
      return (
          <div className="App">
              <Navigation />
              <HomePage 
                  settingClick={this.pushToSetting}
                  modeClick={this.pushToSelectMode}
              />
          </div>
    );
  }
}

export default App;
