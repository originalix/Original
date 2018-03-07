import React, { Component } from 'react';
import { List } from 'antd-mobile';

const Item = List.Item;

class AddLineList extends Component {
    render() {
        return (
            <div>
                <List renderHeader={() => '添加线路'} className="home-list">
                    <Item 
                        thumb="/img/cloud.png"
                        arrow="horizontal"
                    >
                        手动添加线路
                    </Item>
                    <Item 
                        thumb="/img/earth.png"
                        arrow="horizontal"
                    >
                        扫描添加线路
                    </Item>
                    <Item 
                        thumb="/img/earth.png"
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