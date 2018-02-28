import React from 'react';


export default class componentName extends Component {
    render() {
        return (
            <div>
                <h2>Repos</h2>
                <ul>
                    <li><Link to="/repos/reactjs/react-router">React Router</Link></li>
                    <li><Link to="/repos/facebook/react">React</Link></li>
                </ul>
            </div>
        );
    }
}
