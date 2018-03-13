import React, { Component } from 'react';
import './animated.css';

class Animated extends Component {
  render() {
    return (
      <div>
        <h1>Hello World</h1>
        <div className="img-wrap">
          <img src="/China.png" alt=""/>
        </div>
        <div className="rainbow-wrap">
          <h1>Hello CSS</h1>
        </div>
        <div className="rotate"></div>
      </div>
    );
  }
}

export default Animated;
