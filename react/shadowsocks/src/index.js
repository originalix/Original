import React from 'react';
import ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import { createStore, combineReducers } from 'redux';
import { Provider } from 'react-redux';
import reducers from './reducers';
import history from './history/history';
import { Route, Switch } from 'react-router';
import { ConnectedRouter, routerReducer } from 'react-router-redux';

import './index.css';
import App from './components/App/App';
import HomePage from './components/Home/HomePage';
import SelectLine from './components/SelectLine/SelectLine';
import SelectMode from './components/SelectMode/SelectMode';
import ManualAddProxy from './components/AddProxy/ManualAddProxy';
import SelectCountry from './components/AddProxy/SelectCountry';
const store = createStore(
    combineReducers({
        ...reducers,
        routing: routerReducer
    })
);

ReactDOM.render(
    <Provider store={store}>
    <ConnectedRouter history={history}>
    <Switch>
        <Route exact path="/" component={App}/>
        <Route path="/home" component={HomePage}/>
        <Route path="/select" component={SelectLine}/>
        <Route path="/selectmode" component={SelectMode}/>
        <Route path="/addmanual" component={ManualAddProxy}/>
        <Route path='/selectcountry' component={SelectCountry}/>
    </Switch>
    </ConnectedRouter>
    </Provider>,
    document.getElementById('root')
);
registerServiceWorker();
