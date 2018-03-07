import React, { Component } from 'react';
import { List } from 'antd-mobile';
import history from '../../history/history';

const Item = List.Item;

class HomeList extends Component {
    pushToSetting() {
        history.push('/select');
    }
  
    pushToSelectMode() {
        history.push('/selectmode');
    }
    
    render() {        
        return (
            <div>
                <List renderHeader={() => ''} className="home-list">
                    <Item 
                        thumb="/img/cloud.png"
                        arrow="horizontal"
                        extra="韩国(103.86.44.141)"
                        onClick={ () => this.pushToSetting() }
                        >
                        选择服务器
                    </Item>
                    <Item 
                        thumb="/img/earth.png"
                        arrow="horizontal"
                        extra="自动代理模式"
                        onClick={ () => this.pushToSelectMode() }
                        >
                        代理模式
                    </Item>
                </List>
            </div>
        );
    }
}

export default HomeList;
