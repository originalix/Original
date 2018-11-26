/*
 * @Author: Lix 
 * @Date: 2018-04-03 21:36:09 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:19:18
 */

import React, {Component} from 'react';
import { Layout } from 'antd';
import SiderView from '../Layout/Sider';
import FooterView from '../Layout/Footer';
import Api from '../API/Api';

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
              <Route path={`${match.url}/uploadpath`} component={UploadPath}/>
              <Redirect to="/app/uploadpath" />
            </Switch>
          </Content>
          <FooterView/>
        </Layout>
      </Layout>
    );
  }
}

export default Home;

const UploadPath =  () => (
  <Api
    title="上传图片路径"
    url="http://localhost/code-repo/PHP/wxdev/web/image/log"
  />
);

const SquareApi = () => (
  <Api
    title="广场动态"
    url="http://localhost/code-repo/PHP/wxdev/web/sina/home"
  />
);

const ImgCompress = () => (
  <Api
    title="图片压缩"
    url="http://localhost/code-repo/PHP/wxdev/web/image/compress"
  />
);
