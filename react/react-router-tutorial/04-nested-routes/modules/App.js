import React from 'react';
import { Link } from 'react-router';
import NavLink from './NavLink';

export default class App extends React.Component {
    render() {
        return (
            <div>
                <h1>Hello, React Router!</h1>
                <ul role="nav">
                    <li><NavLink to="/about">About</NavLink></li>
                    <li><NavLink to="/repos">Repos</NavLink></li>
                    <li><NavLink to="/repos/reactjs/react-router">React Router</NavLink></li>
                    <li><NavLink to="/repos/facebook/react">React</NavLink></li>
                </ul>

                {this.props.children}
            </div>
        );
    }
};
