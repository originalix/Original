import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import './test.css';
import App from './App';
import registerServiceWorker from './registerServiceWorker';

import { version } from 'antd'
// import Button from 'antd/lib/button'
import { WingBlank, WhiteSpace, Button, DatePicker } from 'antd-mobile';
import 'antd/dist/antd.css'

{/* antd test */}

ReactDOM.render(
    <div style={{ margin: 24 }}>
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
        </WingBlank>
    </div>,
    document.getElementById('root')
);

// ReactDOM.render(<App />, document.getElementById('root'));
// registerServiceWorker();
