import React, { Component } from 'react';
import { Menu, Icon, Switch, Layout } from 'antd';

const SubMenu = Menu.SubMenu;
const { Sider } = Layout;

class SliderView extends Component {
  render() {
    return (
      <Sider width={200} style={{ background: '#fff' }} >
        <Menu
          mode="inline"
          defaultOpenKeys={['sub1']}
          defaultSelectedKeys={['1']}
          style={{ height='100%', borderRight: 0 }}
        >
          <SubMenu key="sub1" title={<span><Icon type="laptop" />API列表</span>}>
            <Menu.Item key="1">压缩图片</Menu.Item>
          </SubMenu>
        </Menu>
      </Sider>
    );
  }
}

export default SliderView;
