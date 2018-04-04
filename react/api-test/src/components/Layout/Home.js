/*
 * @Author: Lix 
 * @Date: 2018-04-03 21:36:09 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:06:05
 */

import React, {Component} from 'react';
import { Layout } from 'antd';
import SiderView from '../Layout/Sider';
import FooterView from '../Layout/Footer';
import ImgCompress from '../API/ImgCompress';
import SquareApi from '../API/SquareApi';

import { Route, Redirect, Switch } from 'react-router-dom';

const { Content } = Layout;

class Home extends Component {
  render() {
    const match = this.props.match;
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
            <Switch>
              <Route path={`${match.url}/imgCompress`} component={ImgCompress}/>
              <Route path={`${match.url}/square`} component={SquareApi}/>
              <Redirect to="/app/imgCompress" />
            </Switch>
          </Content>
          <FooterView/>
        </Layout>
      </Layout>
    );
  }
}

export default Home;
