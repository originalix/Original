import React, { Component } from 'react';
import AddLineList from './AddLineList';
import LineList from './LineList';

class SelectLine extends Component {
    render() {
        return (
            <div>
                <AddLineList />
                <LineList />
            </div>
        );
    }
}

export default SelectLine;