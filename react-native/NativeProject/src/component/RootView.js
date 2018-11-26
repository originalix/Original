import React, { Component } from 'react';
import {
  AppRegistry,
  FlatList,
  StyleSheet,
  Text,
  View,
  Button,
  NativeModules
} from 'react-native';

class RootView extends Component {
  _go2PicListController() {
    const { NaviManager } = NativeModules;
    NaviManager.go2PicListController();
  }

  render() {
    return (
      <View style={styles.container}>
        <Button
          title="跳转到原生TableView"
          onPress={() => this._go2PicListController()}       
        />
        <FlatList
          data={[
            {key: 'Devin'},
            {key: 'Jackson'},
            {key: 'James'},
            {key: 'Joel'},
            {key: 'John'},
            {key: 'Jillian'},
            {key: 'Jimmy'},
            {key: 'Julie'},
          ]}
          renderItem={({item}) => <Text style={styles.item}>{item.key}</Text>}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#ffffff',
    marginTop: 64
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
  },
  item: {  
    padding: 10,
    fontSize: 18,
    height: 44,
  },
});

AppRegistry.registerComponent('NativeProject', () => RootView);
