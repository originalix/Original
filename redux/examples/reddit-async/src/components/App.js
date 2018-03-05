import React, { Component } from 'react';

class App extends Component {
    constructor(props) {
        super(props);
        
    }
    
    componentDidMount() {
        console.log(this.props);
    }

    render() {
        return (
            <div>
                <h1>Hello world</h1>
            </div>
        );
    }
}

export default App;
