import React, { Component } from 'react'
import { connect } from 'react-redux'
import { fetchPostsIfNeeded } from '../actions'

class App extends Component {
    constructor(props) {
        super(props);
        
    }
    
    componentDidMount() {
        const { dispatch } = this.props
        console.log(this.props);
        dispatch(fetchPostsIfNeeded('Kobe'))
    }

    render() {
        return (
            <div>
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
