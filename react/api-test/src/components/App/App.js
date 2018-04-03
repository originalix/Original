/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:58:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-03 16:52:30
 */

import React, { Component } from 'react';
import './App.css';
import 'whatwg-fetch';
import  HeaderView from '../Layout/Header';
import SiderView from '../Layout/Sider';
import { Layout, Button } from 'antd';

const { Content } = Layout;

class App extends Component {
  constructor(props) {
    super(props);
    this.uploadImgTest = this.uploadImgTest.bind(this);
  }
  
  uploadImgTest() {
    fetch('http://192.168.2.103/code-repo/PHP/wxdev/web/image/upload')
      .then(function(response) {
        return response.json()
      }).then(function(json) {
        console.log('parsed json', json)
      }).catch(function(ex) {
        console.log('parsing failed', ex)
      })
  }

  render() {
    return (
      <div className="App">
        <Layout>
          <HeaderView/>
          <Layout>
            <SiderView/>
            <Layout style={{ padding: '0 24px 24px' }}>
              <Content style={{ background: '#fff', padding: 24, margin: 0, minHeight: 280 }}>
                <Button type="primary" onClick={this.uploadImgTest}>上传图片api测试</Button>
              </Content>
            </Layout>
          </Layout>
        </Layout>
      </div>
    );
  }
}

export default App;
