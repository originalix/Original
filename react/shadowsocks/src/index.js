import React from 'react';
import ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import { createStore, combineReducers } from 'redux';
import { Provider } from 'react-redux';
import reducers from './reducers';
// import { Router } from 'react-router';
import { Route, Switch, BrowserRouter as Router } from 'react-router-dom';
import createBrowserHistory from 'history/createBrowserHistory'
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

const history = syncHistoryWithStore(createBrowserHistory(), store);

ReactDOM.render(
    <Provider store={store}>
    <Router>
        <Switch>
            <Route exact path='/' component={App}>
            </Route>
                <Route path='/home' component={HomePage}/>
                <Route path='/select' component={SelectLine}/>
        </Switch>
    </Router>
    </Provider>,
    document.getElementById('root')
);
registerServiceWorker();
