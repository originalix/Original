/*
 * @Author: Lix 
 * @Date: 2018-04-04 10:58:49 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 12:03:02
 */

import React, { Component } from 'react';
import CodeText from '../Layout/CodeText';
import { Button } from 'antd';

class ImgCompress extends Component {
  constructor(props) {
    super(props)
    this.state = {
      codeText: "",
    }
    this.api = this.api.bind(this);
  }
  
  api() {
    fetch('http://localhost/code-repo/PHP/wxdev/web/sina/home')
      .then(response => response.json())
      .then(json => {
        console.log('parsed json', json)
        this.setState({
          codeText: JSON.stringify(json)
        });
      })
      .catch(ex => {console.log('parsed failed', ex)});
  }

  render() {
    return (
      <div>
          <Button type="primary" onClick={this.api}>压缩图片测试</Button>
          <CodeText code={this.state.codeText} />
      </div>
    );
  }
}

export default ImgCompress;
