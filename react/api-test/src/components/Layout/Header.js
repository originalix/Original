/*
 * @Author: Lix 
 * @Date: 2018-04-03 20:47:25 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:18:41
 */

import React, { Component } from 'react';
import { Menu, Layout } from 'antd';
import { Link } from 'react-router-dom';

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
          <Menu.Item key="1"><Link to="/">首页</Link></Menu.Item>
          {/* <Menu.Item key="2"><Link to="/foundation">基础库</Link></Menu.Item>
          <Menu.Item key="3"><Link to="/apilist">基础库</Link></Menu.Item> */}
        </Menu>
      </Header>
    );
  }
}

export default HeaderView;
