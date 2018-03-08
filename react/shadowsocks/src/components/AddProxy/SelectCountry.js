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
            {value: 3, label: '加拿大', icon: 'Canada'},
            {value: 4, label: '德国', icon: 'Germany'},
            {value: 5, label: '法国', icon: 'France'},
            {value: 6, label: '日本', icon: 'Japan'},
            {value: 7, label: '韩国', icon: 'South Korea'},
            {value: 8, label: '新加坡', icon: 'Singapore'},
            {value: 9, label: '英国', icon: 'United Kingdom'},
            {value: 10, label: '澳大利亚', icon: 'Australia'},
            {value: 11, label: '荷兰', icon: 'Netherlands'},
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
