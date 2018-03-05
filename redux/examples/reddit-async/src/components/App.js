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
        const { selectedSubreddit, posts } = this.props;

        console.log('posts: ' + posts);
        const options = ['reactjs', 'redux', 'Python', 'Objective-C', 'Swift']
        return (
            <div>
                <Picker value={selectedSubreddit} onChange={this.handleChange} options={options}/>
                {/* <Posts  /> */}
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
