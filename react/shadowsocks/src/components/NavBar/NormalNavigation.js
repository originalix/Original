import React, { Component } from 'react';
import { NavBar, Icon } from 'antd-mobile';
import './navigation.css';
import history from '../../history/history';

class NormalNavigation extends Component {
    constructor(props) {
        super(props);
        
    }

    goBack() {
        history.goBack();
    }
    
    render() {
        const { title } = this.props;

        return (
            <NavBar 
                mode="dark"
                icon={<Icon type="left" />}
                onLeftClick={() => this.goBack()}
            >
                {title}
            </NavBar>
        );
    }
}

export default NormalNavigation;
