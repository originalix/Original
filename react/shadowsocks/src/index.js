import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './components/App/App';
import registerServiceWorker from './registerServiceWorker';
import { createStore, combineReducers } from 'redux';
import { Provider } from 'react-redux';
import reducers from './reducers';
import { Router, Route } from 'react-router';
import { BrowserRouter } from 'react-router-dom';
import { syncHistoryWithStore, routerReducer } from 'react-router-redux';

const store = createStore(
    combineReducers({
        ...reducers,
        routing: routerReducer
    })
);

ReactDOM.render(
    <Provider store={store}>
        <BrowserRouter>
            <App /> 
        </BrowserRouter>
    </Provider>,
    document.getElementById('root')
);
registerServiceWorker();
