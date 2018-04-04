import React, { Component } from 'react';

class CodeText extends Component {
  render() {
    const { code } = this.props;
    return (
      <div>
        <pre>
          <code class="json">
            {code}
          </code>
        </pre>
      </div>
    );
  }
}

export default CodeText;
