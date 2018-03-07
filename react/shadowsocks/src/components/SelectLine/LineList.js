import React, { Component } from 'react';
import { List } from 'antd-mobile';

const Item = List.Item;

class LineList extends Component {
    render() {
        return (
            <div>
                <List renderHeader={() => '线路列表'} className="home-list">
                    <Item 
                        thumb="/img/cloud.png"
                        extra="55ms"
                    >
                        韩国
                    </Item>
                    <Item 
                        thumb="/img/earth.png"
                        extra="超时"
                    >
                        新加坡
                    </Item>
                </List>
            </div>
        );
    }
}

export default LineList;