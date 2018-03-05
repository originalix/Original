import React, { Component } from 'react'
import { connect } from 'react-redux'
import { selectSubreddit, fetchPostsIfNeeded } from '../actions'
import Picker from './Picker'

class App extends Component {
    constructor(props) {
        super(props);
        
    }
    
    componentDidMount() {
        const { dispatch } = this.props
        console.log(this.props.selectedSubreddit);
        dispatch(fetchPostsIfNeeded('Reactjs'))
    }

    handleChange = nextSubreddit => {
        this.props.dispatch(selectSubreddit(nextSubreddit))
    }

    render() {
        const { selectedSubreddit } = this.props;
        const options = ['Reactjs', 'redux', 'Python', 'Objective-C', 'Swift']
        return (
            <div>
                <Picker value={selectedSubreddit} onChange={this.handleChange} options={options}/>
                <h1>Hello world</h1>
            </div>
        );
    }
}

const mapStateToProps = (state) => {
    console.log('Hello world');
    return state
}

export default connect(mapStateToProps)(App);
