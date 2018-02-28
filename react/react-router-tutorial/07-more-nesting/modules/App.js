import React from 'react';
import { Link, IndexLink } from 'react-router';
import NavLink from './NavLink';
import Home from './Home';

export default class App extends React.Component {
    render() {
        return (
            <div>
                <h1>Hello, React Router!</h1>
                <ul role="nav">
                    <li><IndexLink to="/" activeClassName="active" onlyActiveOnIndex={true}>Home</IndexLink></li>
                    <li><NavLink to="/about">About</NavLink></li>
                    <li><NavLink to="/repos">Repos</NavLink></li>
                </ul>

                {this.props.children}
            </div>
        );
    }
};
