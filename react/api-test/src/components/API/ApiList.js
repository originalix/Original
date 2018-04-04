import React, { Component } from 'react';

class ApiList extends Component {
  render() {
    const match = this.props.match;
    return (
      <div>
        <h1>Api List</h1>
        <h2>{match.params.listId}</h2>
      </div>
    );
  }
}

export default ApiList;
