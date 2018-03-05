import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { selectSubreddit, fetchPostsIfNeeded, invalidateSubreddit } from '../actions'
import Picker from './Picker'
import Posts from './Posts'

class App extends Component {
    constructor(props) {
        super(props);
        
    }

    static propTypes = {
        selectedSubreddit: PropTypes.string.isRequired,
        posts: PropTypes.array.isRequired,
        isFetching: PropTypes.bool.isRequired,
        lastUpdated: PropTypes.number,
        dispatch: PropTypes.func.isRequired
    }
    
    componentDidMount() {
        const { dispatch, selectedSubreddit } = this.props
        console.log(this.props.selectedSubreddit);
        dispatch(fetchPostsIfNeeded(selectedSubreddit))
    }

    handleChange = nextSubreddit => {
        this.props.dispatch(selectSubreddit(nextSubreddit))
    }

    render() {
        const { selectedSubreddit, posts, isFetching, lastUpdated } = this.props;
        const options = ['reactjs', 'redux', 'Python', 'Objective-C', 'Swift']
        const isEmpty = posts.length === 0

        return (
            <div>
                <Picker value={selectedSubreddit} 
                        onChange={this.handleChange} 
                        options={options} />
                <p>
                    { lastUpdated &&
                        <span>
                            Last Updated at {new Date(lastUpdated).toLocaleTimeString()}.
                            {' '}
                        </span>
                    }
                    { !isFetching &&
                        <button onClick={function(){}}>
                            Refresh
                        </button>
                    }
                </p>
                <Posts posts={posts} />
            </div>
        );
    }
}

const mapStateToProps = state => {
    console.log('Hello world');
    const { selectedSubreddit, postsBySubreddit } = state
    const {
        isFetching,
        lastUpdated,
        items: posts
    } = postsBySubreddit[selectedSubreddit] || {
        isFetching: true,
        items: []
    }

    return {
        selectedSubreddit,
        posts,
        isFetching,
        lastUpdated
    }
}

export default connect(mapStateToProps)(App);
