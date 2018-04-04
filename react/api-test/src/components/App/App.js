/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:58:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 10:31:23
 */

import React, { Component } from 'react';
import './App.css';
import 'whatwg-fetch';
import HeaderView from '../Layout/Header';
import Home from '../Layout/Home';
import Foundation from '../API/Foundation';
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
                <Route path="/foundation" component={Foundation} />
                <Redirect to="/app" />
              </Switch>
            </Layout>
        </div>
      </Router>
    );
  }
}

export default App;
