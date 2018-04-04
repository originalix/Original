/*
 * @Author: Lix 
 * @Date: 2018-04-04 10:58:49 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:09:57
 */

import React, { Component } from 'react';
import CodeText from '../Layout/CodeText';
import { Button } from 'antd';

class Api extends Component {
  constructor(props) {
    super(props)
    this.state = {
      codeText: "",
      loading: false,
    }
    this.api = this.api.bind(this);
  }

  enterLoading = () => {
    this.setState({ loading: true });
  }

  api() {
    this.enterLoading();
    const { url } = this.props;
    fetch(url)
      .then(response => response.json())
      .then(json => {
        this.setState({
          codeText: JSON.stringify(json),
          loading: false
        });
      })
      .catch(ex => {console.log('parsed failed', ex)});
  }

  render() {
    const { title } = this.props;
    return (
      <div>
          <Button type="primary" onClick={this.api} loading={this.state.loading}>{title}</Button>
          <CodeText code={this.state.codeText} />
      </div>
    );
  }
}

export default Api;
