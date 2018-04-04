/*
 * @Author: Lix 
 * @Date: 2018-04-03 21:36:09 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 10:33:26
 */

import React, {Component} from 'react';
import { Layout } from 'antd';
import SiderView from '../Layout/Sider';
import FooterView from '../Layout/Footer';
import ApiList from '../API/ApiList';

import { Route, Redirect } from 'react-router-dom';

const { Content } = Layout;

class Home extends Component {
  render() {
    const match = this.props.match;
    console.log(match);
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
            <Route path={`${match.url}/list`} component={ApiList}/>
            <Redirect from="/app" to="/app/list" />
          </Content>
          <FooterView/>
        </Layout>
      </Layout>
    );
  }
}

export default Home;
