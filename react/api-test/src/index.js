import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './components/App/App';
import registerServiceWorker from './registerServiceWorker';
// import { BrowserRouter as Router, Link, Route } from 'react-router-dom';

ReactDOM.render(<App/>, document.getElementById('root'));

// ReactDOM.render((
//   <Router>
//     <App />
//   </Router>
// ), document.getElementById('root'));
registerServiceWorker();


