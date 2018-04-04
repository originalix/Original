/*
 * @Author: Lix 
 * @Date: 2018-04-04 14:24:36 
 * @Last Modified by:   Lix 
 * @Last Modified time: 2018-04-04 14:24:36 
 */

import React, { Component } from 'react';
import jsonFormat from '../../Tools';
import Highlight from 'react-highlight';
import 'highlight.js/styles/monokai.css';
import './CodeTest.css';

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
