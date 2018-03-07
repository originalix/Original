import React, { Component } from 'react';
import { NavBar, Icon } from 'antd-mobile';
import './navigation.css';
import { BrowserHistory } from 'react-router';

class NormalNavigation extends Component {
    render() {
        const { goBack, title } = this.props;

        return (
            <NavBar 
                mode="dark"
                icon={<Icon type="left" />}
                onLeftClick={() => goBack()}
            >
                {title}
            </NavBar>
        );
    }
}

export default NormalNavigation;
