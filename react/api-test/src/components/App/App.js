/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:58:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-03 17:13:29
 */

import React, { Component } from 'react';
import './App.css';
import 'whatwg-fetch';
import  HeaderView from '../Layout/Header';
import SiderView from '../Layout/Sider';
import FooterView from '../Layout/Footer';

import { Layout, Button } from 'antd';

const { Content } = Layout;

class App extends Component {

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
              <FooterView/>
            </Layout>
          </Layout>
        </Layout>
      </div>
    );
  }
}

export default App;
