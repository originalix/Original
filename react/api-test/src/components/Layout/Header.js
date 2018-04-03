import React, { Component } from 'react';
import { Menu, Layout } from 'antd';
import { Route, Link } from 'react-router-dom';
import Test from '../API/Test';

const { Header } = Layout;

class HeaderView extends Component {
  render() {
    return (
      <Header className="header">
        <Menu
          theme="dark"
          mode="horizontal"
          defaultSelectedKeys={['1']}
          style={{ lineHeight: '44px' }}
        >
          <Menu.Item key="1">首页</Menu.Item>
          <Menu.Item key="2">基础库</Menu.Item>
          <Menu.Item key="3">LNTSAPI</Menu.Item>
        </Menu>
        
        {/* <Route path='/test' component={Test}/> */}
      </Header>
    );
  }
}

export default HeaderView;
