import React, { Component } from 'react';
import { Menu, Layout } from 'antd';
import { Route, Link } from 'react-router-dom';

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
          <Menu.Item key="2"><Link to="/test">基础库</Link></Menu.Item>
          <Menu.Item key="3">LNTSAPI</Menu.Item>
        </Menu>
      </Header>
    );
  }
}

export default HeaderView;
