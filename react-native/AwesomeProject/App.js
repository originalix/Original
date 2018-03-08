import React, {Component} from 'react'
import {Text, View, Image, StyleSheet, AppRegistry} from 'react-native'

class App extends Component {
  render() {
    let pic = {
      uri: 'https://upload.wikimedia.org/wikipedia/commons/d/de/Bananavarieties.jpg'
    };
    return (
      <View style={styles.wrap}>
        <View style={styles.position}></View>
        <Text style={styles.wrap}>
          textInComponent
        </Text>
        <Text style={[styles.red, styles.bigblue]}>Hello React-Native</Text>
        <Image
          source={pic}
          style={{
          width: 193,
          height: 110
        }}/>
        <View style={{
          alignItems: 'center'
        }}>
          <Greeting name='Kobe'/>
          <Greeting name='Curry'/>
          <Greeting name='Durant'/>
        </View>
      </View>
    )
  }
}

export default App;

const styles = StyleSheet.create({
  wrap: {
    fontSize: 30,
    marginTop: 20,
    alignItems: 'center'
  },
  bigblue: {
    color: 'blue',
    fontWeight: 'bold',
    fontSize: 30
  },
  red: {
    color: 'red'
  },
  position: {
    width: 150,
    height: 150,
    backgroundColor: 'skyblue'
  }
});

class Greeting extends Component {
  render() {
    return (
      <Text>Hello {this.props.name}!</Text>
    );
  }
}

class FlexDimensionsBasics extends Component {
  render() {
    return (
      <View style={{
        flex: 1
      }}>
        <View
          style={{
          flex: 1,
          backgroundColor: 'powderblue'
        }}/>
        <View
          style={{
          flex: 2,
          backgroundColor: 'skyblue'
        }}/>
        <View
          style={{
          flex: 3,
          backgroundColor: 'steelblue'
        }}/>
      </View>
    )
  }
}
