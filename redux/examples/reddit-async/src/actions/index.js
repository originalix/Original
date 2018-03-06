import fetch from 'cross-fetch'

export const SELECT_SUBREDDIT = 'SELECT_SUBREDDIT'
export const REQUEST_POSTS = 'REQUEST_POSTS';
export const RECEIVE_POSTS = 'RECEIVE_POSTS'
export const INVALIDATE_SUBREDDIT = 'INVALIDATE_SUBREDDIT'

export const selectSubreddit = subreddit => ({
    type: SELECT_SUBREDDIT,
    subreddit
})

const requestPosts = subreddit => ({
    type: REQUEST_POSTS,
    subreddit
})

const receivePosts = (subreddit, json) => ({
    type: RECEIVE_POSTS,
    subreddit,
    posts: json.data.children.map( child => child.data ),
    receivedAt: Date.now()
})

export const invalidateSubreddit = subreddit => ({
    type: INVALIDATE_SUBREDDIT,
    subreddit
})

export function fetchPosts(subreddit) {
    return dispatch => {
        dispatch(requestPosts(subreddit))
        return fetch(`http://www.reddit.com/r/${subreddit}.json`)
            .then(response => response.json())
            .then(json => dispatch(receivePosts(subreddit, json)))
    }
}


function shouldFetchPosts(state, subreddit) {
    const posts = state.postsBySubreddit[subreddit]
    if (!posts) {
        return true
    } else if (posts.isFetching) {
        return false
    } else {
        return posts.didInvalidate
    }
}

export function fetchPostsIfNeeded(subreddit) {

    // 注意这个函数也接收了 getState()方法
    // 它让你选择接下来dispatch什么
    
    // 当缓存的值是可用时，
    // 减少网络请求很有用

    return (dispatch, getState) => {
        if (shouldFetchPosts(getState(), subreddit)) {
            
            // 在一个thunk 里 dispatch 另一个 thunk!
            return dispatch(fetchPosts(subreddit))
        } else {

            // 告诉调用代码不需要等待
            return Promise.resolve()
        }
    }
}
