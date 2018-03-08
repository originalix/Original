import React, { Component } from 'react';
import { List } from 'antd-mobile';
import history from '../../history/history';
import './selectline.css';

const Item = List.Item;

class AddLineList extends Component {
    pushToManualAddProxy() {
        history.push('/addmanual')
    }

    render() {
        return (
            <div>
                <List renderHeader={() => '添加线路'} className="home-list">
                    <Item 
                        thumb={<i className="iconfont listicon">&#xe83e;</i>}
                        arrow="horizontal"
                        onClick={ () => this.pushToManualAddProxy() }
                    >
                        手动添加线路
                    </Item>
                    <Item 
                        thumb={<i className="iconfont listicon">&#xe62f;</i>}
                        arrow="horizontal"
                    >
                        扫描添加线路
                    </Item>
                    <Item 
                        thumb={<i className="iconfont listicon">&#xe6e7;</i>}
                        arrow="horizontal"
                    >
                        延迟测试
                    </Item>
                </List>
            </div>
        );
    }
}

export default AddLineList;