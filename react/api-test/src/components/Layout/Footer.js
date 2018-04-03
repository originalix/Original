import React, { Component } from 'react';
import { Layout } from 'antd';

const { Footer } = Layout;

class FooterView extends Component {
  render() {
    return (
      <Footer style={{ textAligin: 'center' }}>
        API Test ©2018 Created by Leon
      </Footer>
    );
  }
}

export default FooterView;
