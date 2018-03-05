import thunkMiddleware from 'redux-thunk'
import { createLogger } from 'redux-logger'
import { createStore, applyMiddleware } from 'redux'
import { selectSubreddit, fetchPosts } from './actions'
import rootReducer from './reducers'

const loggerMiddleware = createLogger()

const store = createStore(
    rootReducer,
    applyMiddleware(
        thunkMiddleware,
        loggerMiddleware
    )
)

store.dispatch(selectSubreddit('reactjs'))
store
    .dispatch(fetchPosts('reactjs'))
    .then(() => console.log(store.getState())
)
