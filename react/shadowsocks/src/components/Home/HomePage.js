import React, { Component } from 'react';
import ConnectView from './ConnectView';
import List from './List';
import './homePage.css';

class HomePage extends Component {
    render() {
        const { settingClick, modeClick } = this.props;

        return (
            <div className="home-wrap">
                <ConnectView />
                <List 
                    settingClick={settingClick}
                    modeClick={modeClick}
                />
            </div>
        );
    }
}

export default HomePage;
