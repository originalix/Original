import React, { Component } from 'react';
import './selectMode.css';
import NormalNavigation from '../NavBar/NormalNavigation';
import { List, Radio } from 'antd-mobile';

const RadioItem = Radio.RadioItem;

class SelectMode extends Component {
    state = {
        value: 0,
        value2: 1,
    };

    onChange = (value) => {
        console.log('checkbox');
        this.setState({
            value,
        });
    }
    
    render() {
        const { value } = this.state;

        const data = [
            { value: 0, label: '自动代理模式' },
            { value: 1, label: '全局代理模式' }
        ];

        return (
            <div>
                <NormalNavigation title="代理模式" />
                <List renderHeader={() => '选择代理模式'} className="home-list">
                    {data.map( i => (
                        <RadioItem 
                            key={i.value}
                            checked={value===i.value}
                            onChange={() => this.onChange(i.value)}
                        >
                            {i.label}
                        </RadioItem>
                    ))}
                </List>
            </div>
        );
    }
}

export default SelectMode;
