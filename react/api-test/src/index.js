/*
 * @Author: Lix 
 * @Date: 2018-04-04 10:59:15 
 * @Last Modified by:   Lix 
 * @Last Modified time: 2018-04-04 10:59:15 
 */

import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './components/App/App';
import registerServiceWorker from './registerServiceWorker';

ReactDOM.render(<App/>, document.getElementById('root'));
registerServiceWorker();
