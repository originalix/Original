/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:58:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:21:57
 */

import React, { Component } from 'react';
import 'whatwg-fetch';
import './App.css';
import HeaderView from '../Layout/Header';
import Home from '../Layout/Home';
import { Route, BrowserRouter as Router, Switch, Redirect } from 'react-router-dom';

import { Layout } from 'antd';

class App extends Component {

  render() {
    return (
      <Router>
        <div className="App">
            <Layout>
              <HeaderView/>
              <Switch>
                <Route path="/app" component={Home} />
                <Redirect to="/app" />
              </Switch>
            </Layout>
        </div>
      </Router>
    );
  }
}

export default App;
