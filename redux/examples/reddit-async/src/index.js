import React from 'react'
import { render } from 'react-dom'
import thunkMiddleware from 'redux-thunk'
import { createLogger } from 'redux-logger'
import { createStore, applyMiddleware } from 'redux'
import { selectSubreddit, fetchPosts } from './actions'
import rootReducer from './reducers/reducers'
import { Provider } from 'react-redux'
import App from './components/App'

const loggerMiddleware = createLogger()

const store = createStore(
    rootReducer,
    applyMiddleware(
        thunkMiddleware,
        loggerMiddleware
    )
)

// store.dispatch(selectSubreddit('reactjs'))
// store
//     .dispatch(fetchPosts('reactjs'))
//     .then(() => console.log(store.getState())
// )

render (
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById('root')
);
