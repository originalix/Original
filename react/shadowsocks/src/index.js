import React from 'react';
import ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import { createStore, combineReducers } from 'redux';
import { Provider } from 'react-redux';
import reducers from './reducers';
import { Router, Route } from 'react-router';
import { BrowserRouter } from 'react-router-dom';
import { syncHistoryWithStore, routerReducer } from 'react-router-redux';
import './index.css';
import App from './components/App/App';
import HomePage from './components/Home/HomePage';
import SelectLine from './components/SelectLine/SelectLine';

const store = createStore(
    combineReducers({
        ...reducers,
        routing: routerReducer
    })
);

ReactDOM.render(
    <Provider store={store}>
        <BrowserRouter>
            <Route path='/' component={App}>
                <Route path='/home' component={HomePage}/>
                <Route path='/select' component={SelectLine}/>
            </Route>
        </BrowserRouter>
    </Provider>,
    document.getElementById('root')
);
registerServiceWorker();
