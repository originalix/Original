import React, { Component } from 'react';
import jsonFormat from '../../Tools';
import Highlight from 'react-highlight';
import 'highlight.js/styles/gruvbox-dark.css';

class CodeText extends Component {

  render() {
    const { code } = this.props;
    return (
      <div id="codeText">
        <Highlight className="javascript">
          {code}
        </Highlight>
      </div>
    );
  }
}

export default CodeText;
