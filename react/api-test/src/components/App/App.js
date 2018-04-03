/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:58:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-03 21:40:30
 */

import React, { Component } from 'react';
import './App.css';
import 'whatwg-fetch';
import HeaderView from '../Layout/Header';
import Home from '../Layout/Home';
import Foundation from '../API/Foundation';
import ApiList from '../API/ApiList';
import { Route, BrowserRouter as Router, Switch } from 'react-router-dom';

import { Layout } from 'antd';

class App extends Component {

  render() {
    return (
      <Router>
        <div className="App">
            <Layout>
              <HeaderView/>
              <Switch>
                <Route exact path="/app" component={Home} />
                <Route path="/foundation" component={Foundation} />
                <Route path="/list" component={ApiList} />
              </Switch>
            </Layout>
        </div>
      </Router>
    );
  }
}

export default App;
