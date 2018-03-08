import React, { Component } from 'react';
import { List, Radio } from 'antd-mobile';
import NormalNavigation from '../NavBar/NormalNavigation';
import './manualAddProxy.css';

const RadioItem = Radio.RadioItem;

class SelectCountry extends Component {
    render() {
        const data = [
            {value: 0, label: '火星', icon: 'flag1'},
            {value: 1, label: '美国', icon: 'United States'},
            {value: 2, label: '香港', icon: 'Hong Kong'},
            {value: 3, label: '加拿大', icon: ''},
            {value: 3, label: '德国', icon: ''},
            {value: 3, label: '法国', icon: ''},
            {value: 3, label: '日本', icon: ''},
            {value: 3, label: '韩国', icon: ''},
            {value: 3, label: '新加坡', icon: ''},
            {value: 3, label: '加拿大', icon: ''},
        ];
        return (
            <div>
                <NormalNavigation title="选择国家" />
                <List renderHeader={() => '国家'}>
                    {data.map(i => {
                        const icon = "/img/flag/" + i.icon + ".png"; 
                        return <RadioItem
                                    key={i.value}
                                    checked={false}
                                    onChange={() => console.log('111')}
                                    thumb={icon}
                                >
                            {i.label}
                        </RadioItem>
                    })}
                </List>
            </div>
        );
    }
}

export default SelectCountry;
