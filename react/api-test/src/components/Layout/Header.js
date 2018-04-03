import React, { Component } from 'react';
import { Menu, Layout } from 'antd';

const { Header } = Layout;

class HeaderView extends Component {
  render() {
    return (
      <Header className="header">
        <Menu
          theme="dark"
          mode="horizontal"
          defaultSelectedKeys={['2']}
          style={{ lineHeight: '64px' }}
        >
          <Menu.Item key="1">首页</Menu.Item>
          <Menu.Item key="2">基础库</Menu.Item>
          <Menu.Item key="3">LNTSAPI</Menu.Item>
        </Menu>
      </Header>
    );
  }
}

export default HeaderView;
