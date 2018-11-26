import React, { Component } from 'react';
import AddLineList from './AddLineList';
import LineList from './LineList';
import './selectline.css';
import NormalNavigation from '../NavBar/NormalNavigation';

class SelectLine extends Component {
    render() {
        return (
            <div>
                <NormalNavigation title="选择线路" />
                <AddLineList />
                <LineList />
            </div>
        );
    }
}

export default SelectLine;
