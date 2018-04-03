import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './components/App/App';
import Test from './components/API/Test';
import registerServiceWorker from './registerServiceWorker';

import { Route, BrowserRouter as Router } from 'react-router-dom';

ReactDOM.render((
  <Router>
    <div style={{ height:'100%' }}>
      <Route exact path='/' component={App}/>
      <Route path='/test' component={Test}/>
    </div>
  </Router>
), document.getElementById('root'));
registerServiceWorker();
