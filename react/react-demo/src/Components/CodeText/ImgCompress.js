import React, { Component } from 'react';
import CodeText from '../Layout/CodeText';
import { Button } from 'antd';

class ImgCompress extends Component {
  constructor(props) {
    super(props)
    this.state = {
      codeText: "",
      loading: false,
    }
    this.api = this.api.bind(this);
  }

  render() {
    return (
      <div>
          <Button type="primary" onClick={this.api} loading={this.state.loading}>压缩图片测试</Button>
          <CodeText code={this.state.codeText} />
      </div>
    );
  }
}

export default ImgCompress;
