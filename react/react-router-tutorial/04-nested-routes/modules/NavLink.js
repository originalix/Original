import React from 'react';
import { Link } from 'react-router';

export default class NavLink extends React.Component {
    render() {
        return (
            <Link {...this.props} activeStyle={{ color: 'red' }} activeClassName="active" />
        );
    }
};
