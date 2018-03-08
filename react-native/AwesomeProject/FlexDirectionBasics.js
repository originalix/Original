import React, { Component } from 'react';
import { View } from 'react-native';

class FlexDirectionBasics extends Component {
  render() {
    return (
      <View style={{flex: 1, flexDirection: 'row', marginTop: 50, flexWrap: 'wrap'}}>
        <View style={{width: 100, height: 150, backgroundColor: 'blue'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'skyblue'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'red'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'skyblue'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'blue'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'red'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'red'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'blue'}} />
        <View style={{width: 100, height: 150, backgroundColor: 'skyblue'}} />
      </View>
    );
  }
}

export default FlexDirectionBasics;
