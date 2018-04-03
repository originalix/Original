/*
 * @Author: Lix 
 * @Date: 2018-04-03 21:36:09 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-03 21:40:44
 */

import React, {Component} from 'react';
import { Layout, Button } from 'antd';
import SiderView from '../Layout/Sider';
import FooterView from '../Layout/Footer';
import ApiList from '../API/ApiList';

import { Route, Link } from 'react-router-dom';

const { Content } = Layout;

class Home extends Component {
  render() {
    return (
      <Layout>
        <SiderView/>
        <Layout style={{
          padding: '0 24px 24px'
        }}>
          <Content
            style={{
            background: '#fff',
            padding: 24,
            marginTop: '24px',
            minHeight: 280
          }}>
            <Button type="primary" onClick={this.uploadImgTest}>上传图片api测试</Button>
            <ul>
              <li>
                <Link to="/app/list">List</Link>
              </li>
            </ul>
            <Route path="/app/list" component={ApiList} />
          </Content>
          <FooterView/>
        </Layout>
      </Layout>
    );
  }
}

export default Home;
