import React, { Component } from 'react';
import { List } from 'antd-mobile';

const Item = List.Item;

class HomeList extends Component {
    render() {
        return (
            <div>
                <List renderHeader={() => ''} className="home-list">
                    <Item 
                        thumb="/img/cloud.png"
                        arrow="horizontal"
                        extra="韩国(103.86.44.141)">
                        选择服务器
                    </Item>
                    <Item 
                        thumb="/img/earth.png"
                        arrow="horizontal"
                        extra="自动代理模式">
                        代理模式
                    </Item>
                </List>
            </div>
        );
    }
}

export default HomeList;
