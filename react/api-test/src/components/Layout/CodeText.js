import React, { Component } from 'react';
import jsonFormat from '../../Tools';
import Highlight from 'react-highlight';
import 'highlight.js/styles/monokai.css';

class CodeText extends Component {

  render() {
    const { code } = this.props;
    return (
      <div id="codeText">
        <Highlight className="javascript">
          {jsonFormat(code)}
        </Highlight>
      </div>
    );
  }
}

export default CodeText;
