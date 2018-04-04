import React, { Component } from 'react';
import jsonFormat from '../../Tools';
import 'highlight.js/styles/github.css'

class CodeText extends Component {

  highlight(code, lang) {
    const hljs = require('highlight.js');
    if (typeof lang === 'undefined') {
      return hljs.highlightAuto(code).value;
    } else if (lang === 'nohighlight') {
      return code;
    } else {
      // let a = document.getElementById('codeText');
      var b = document.querySelectorAll("pre");
      console.log(b);
      if (b.length > 0) {
        // alert('有了B');
        b.each(function (i, block) {
          hljs.highlightBlock(block);
        })
      }
      // hljs.highlightBlock(code);
      return hljs.highlight(lang, code).value;
      // return hljs.highlightBlock(code);
    }
  }

  render() {
    const { code } = this.props;
    // const formatCode = jsonFormat(code);
    // console.log(formatCode);
    const highlightCode = this.highlight(code, 'javascript');
    return (
      <div id="codeText">
        <pre>
          <code dangerouslySetInnerHTML={{ __html: highlightCode}}>
            {/* {highlightCode} */}

          </code>
        </pre>
      </div>
    );
  }
}

export default CodeText;
