import fetch from 'cross-fetch'

export const REQUEST_POSTS = 'REQUEST_POSTS';
function requestPosts(subreddit) {
    return {
        type: REQUEST_POSTS,
        subreddit
    }
}

export const RECEIVE_POSTS = 'RECEIVE_POSTS'
function receivePosts(subreddit, json) {
    return {
        type: RECEIVE_POSTS,
        subreddit,
        posts: json.data.children.map( child => child.data ),
        receivedAt: Date.now()
    }
}
