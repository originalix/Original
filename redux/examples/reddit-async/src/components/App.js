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
        dispatch(selectSubreddit('React'))
        dispatch(fetchPostsIfNeeded('Kobe'))
    }

    handleChange = nextSubreddit => {
        this.props.dispatch(selectSubreddit(nextSubreddit))
    }

    render() {
        const { selectedSubreddit } = this.props;
        return (
            <div>
                <Picker value={selectedSubreddit} onChange={this.handleChange} options={[ 'reactjs', 'Kobe' ]}/>
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
