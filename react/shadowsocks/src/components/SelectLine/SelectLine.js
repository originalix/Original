import React, { Component } from 'react';
import AddLineList from './AddLineList';
import LineList from './LineList';
import './selectline.css';
import NormalNavigation from '../NavBar/NormalNavigation';
import ManualAddProxy from '../AddProxy/ManualAddProxy';
import { goBack } from 'history';

class SelectLine extends Component {
    constructor(props) {
        super(props);
    }
    
    render() {
        return (
            <div>
                <NormalNavigation title="选择线路" />
                <AddLineList
                    manualAdd={this.pushToManualAddProxy}
                />
                <LineList />
            </div>
        );
    }
}

export default SelectLine;
