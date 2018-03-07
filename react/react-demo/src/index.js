import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import './test.css';
import App from './App';
import registerServiceWorker from './registerServiceWorker';

import { version } from 'antd'
// import Button from 'antd/lib/button'
import { WingBlank, WhiteSpace, Button, DatePicker, NavBar, Icon } from 'antd-mobile';
import 'antd/dist/antd.css'

{/* antd test */}

ReactDOM.render(
    <div>
        <NavBar
            mode="light"
            icon={<Icon type="left" />}
            onLeftClick={() => console.log('onLeftClick')}
            rightContent={[
                <Icon key="0" type="search" style={{ marginRight: '16px' }} />,
                <Icon key="1" type="ellipsis" />,
            ]}
        >NavBar</NavBar>
        <h1>Test Sass</h1>
        <p style={{ marginBottom: 24 }}>
            Current antd version: {version} <br/>
            You can change antd version.
        </p>
        {/* <Button type="primary">Button</Button> */}
        {/* <Button type="primary" size="small" inline>small</Button> */}
        <WingBlank>
            <Button>default</Button><WhiteSpace />
            <Button type="warning" disabled>warning disabled</Button><WhiteSpace />
            <Button loading>loading button</Button><WhiteSpace />
        </WingBlank>
    </div>,
    document.getElementById('root')
);

// ReactDOM.render(<App />, document.getElementById('root'));
// registerServiceWorker();
