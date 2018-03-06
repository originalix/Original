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

export const fetchPosts = subreddit => dispatch => {
    dispatch(requestPosts(subreddit))
    return fetch(`http://www.reddit.com/r/${subreddit}.json`)
        .then(response => response.json())
        .then(json => dispatch(receivePosts(subreddit, json)))
}

const shouldFetchPosts = (state, subreddit) => {
    const posts = state.postsBySubreddit[subreddit]
    if (!posts) {
        return true
    } else if (posts.isFetching) {
        return false
    } else {
        return posts.didInvalidate
    }
}

export const fetchPostsIfNeeded = subreddit => (dispatch, getState) => {
    // 注意这个函数也接收了 getState()方法
    // 它让你选择接下来dispatch什么
    
    // 当缓存的值是可用时，
    // 减少网络请求很有用
    if (shouldFetchPosts(getState(), subreddit)) {
        return dispatch(fetchPosts(subreddit))
    }
}
