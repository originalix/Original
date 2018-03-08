import { AppRegistry } from 'react-native';
import App from './App';

import React from 'react';
import { View, Text } from 'react-native';
import { StackNavigator } from 'react-navigation';

// import FlexDirectionBasics from './FlexDirectionBasics';
// import JustifyContentBasics from './JustifyContentBasics';
// import PizzaTranslator from './PizzaTranslator';
// import FlatListBasics from './FlatListBasics';

class HomeScreen extends React.Component {
  render() {
    return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text>Home Screen</Text>
      </View>
    );
  }
}

const Bpp = StackNavigator({
  Home: {
    screen: HomeScreen,
  },
});

AppRegistry.registerComponent('AwesomeProject', () => Bpp);
