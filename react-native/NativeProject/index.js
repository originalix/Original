import React, {Component} from 'react';
import {AppRegistry, StyleSheet, Text, View} from 'react-native';

class RNView extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Text style={styles.highScoresTitle}>This is React Native View.</Text>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#FFFFFF'
  },
  highScoresTitle: {
    fontSize: 20,
    textAlign: 'center',
    margin: 10
  },
  scores: {
    textAlign: 'center',
    color: '#333333',
    marginBottom: 5
  }
});

AppRegistry.registerComponent('NativeProject', () => RNView);
