import React, { Component } from 'react';
import { NavBar, Icon } from 'antd-mobile';
import './navigation.css';

class Navigation extends Component {
    render() {
        return (
            <NavBar 
                mode="dark"
                icon={<i className="iconfont left-item">&#xe62f;</i>}
            >
                ShadowSocks
            </NavBar>
        );
    }
}

export default Navigation;