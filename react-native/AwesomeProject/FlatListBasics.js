import React, { Component } from 'react';
import { FlatList, StyleSheet, Text, View } from 'react-native';

class FlatListBasics extends Component {
  render() {
    const data = [
      {key: 'Devin'},
      {key: 'Jackson'},
      {key: 'James'},
      {key: 'Joel'},
      {key: 'John'},
      {key: 'Jillian'},
      {key: 'Jimmy'},
      {key: 'Julie'},
    ];
    return (
      <View>
        <FlatList 
          data={data}
          renderItem={(item) => <Text>{item.key}</Text>}
        />
      </View>
    );
  }
}

export default FlatListBasics;
