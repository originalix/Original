import React, { Component } from 'react';
import ConnectView from './ConnectView';
import List from './List';
import './homePage.css';

class HomePage extends Component {
    render() {
        return (
            <div className="home-wrap">
                <ConnectView />
                <List />
            </div>
        );
    }
}

export default HomePage;
