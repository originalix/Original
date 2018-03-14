import React, { Component } from 'react';
import { View, Text, Button, Image, TouchableHighlight, NativeModules, NativeEventEmitter, InteractionManager } from 'react-native';
import { StackNavigator, TabNavigator, TabBarBottom } from 'react-navigation';
import FadeInView from './FadeInView';

class LogoTitle extends Component {
  render() {
    return (
      <Image
        source={require('./favicon.png')}
        style={{ width: 30, height: 30 }}
      />
    );
  }
}

class MyButton extends Component {
  _onPressButton() {
    console.log("You tapped the button");
    let CalendarManager = NativeModules.CalendarManager;
    // CalendarManager.addEvent('Birthday Party', '4 Privet Drive, Surrey', date.toISOString());
    let date = new Date();
    // CalendarManager.addEvent('Birthday Party', '4 Privet Drive, Surrey', date.toISOString());
    CalendarManager.addEvent('Play Basketball', {
      location: '全民健身中心',
      time: date,
      description: 'balabala...'
    });

    // CalendarManager.findEvent((error, events) => {
    //   if (error) {
    //     console.log(error);
    //   } else {
    //     console.log(events);
    //   }
    // })
  }

  render() {
    return (
      <TouchableHighlight onPress={this._onPressButton}>
        <Text>TouchableHighlight</Text>
      </TouchableHighlight>
    );
  }
}

const { CalendarManager } = NativeModules;
const calendarManagerEmitter = new NativeEventEmitter(CalendarManager);

class HomeScreen extends Component {
  static navigationOptions = ({ navigation }) => {
    // title: 'Home',
    const params = navigation.state.params || {};
    return {
      headerTitle: <LogoTitle />,
      headerRight: (
        <Button
          onPress={params.increaseCount}
          title="+1"
          color="#fff"
        />
      ),
      headerLeft: (
        <Button
          onPress={() => navigation.navigate('MyModal')}
          title="Modal"
          color="#fff"
        />
      ),
      headerBackTitle: "",
    }
  };

  componentWillMount() {
    this.props.navigation.setParams({ increaseCount: this._increaseCount });
  }

  componentDidMount() {
    const subscription = calendarManagerEmitter.addListener(
      'EventReminder',
      (render) => console.log('----------->' + render.name)
    );
  }

  componentWillUnmount() {
    // subscription.remove();
    calendarManagerEmitter.remove();
  }

  state = {
    count: 0,
  };

  _increaseCount = () => {
    this.setState({ count: this.state.count + 1 });
  }

  _goNativeViewController = () => {
    const { PushNative } = NativeModules;
    InteractionManager.runAfterInteractions( () => {
      PushNative.RNOpenNativeVC("Open TestViewController");
    });
  }

  render() {
    return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text>Home Screen</Text>
        <Text>{this.state.count}</Text>
        <Button
          title="Go to Details"
          onPress={() => {
            this.props.navigation.navigate('Details', {
              itemId: 21,
              otherParams: 'anything you want here',
            });
          }}
        />
        <MyButton/>
        <FadeInView style={{width: 250, height: 70, backgroundColor: 'powderblue'}}>
          <Text style={{ fontSize: 28, textAlign: 'center', margin: 10 }}>Fading in</Text>
        </FadeInView>
        <Button
          title="跳转原生界面"
          onPress={() => this._goNativeViewController()}
        />
      </View>
    );
  }
}

class DetailsScreen extends Component {
  static navigationOptions = ({ navigation, navigationOptions }) => {
    const { params } = navigation.state;
    
    return {
      title: params ? params.otherParams : 'A Nested Details Screen',
      headerStyle: {
        backgroundColor: navigationOptions.headerTintColor,
      },
      headerTintColor: navigationOptions.headerStyle.backgroundColor,
    }
  };
  
  render() {
    const { params } = this.props.navigation.state;
    const itemId = params ? params.itemId : null;
    const otherParams = params ? params.otherParams : null;

    return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text>Details Screen</Text>
        <Text>itemId: {JSON.stringify(itemId)}</Text>
        <Text>otherParams: {JSON.stringify(otherParams)}</Text>
        <Button
          title="Go to Details...again"
          onPress={() => this.props.navigation.navigate('Details')}
        />
        <Button
          title="Go back"
          onPress={() => this.props.navigation.goBack()}
        />
        <Button 
          title="Update the title"
          onPress={() => this.props.navigation.setParams({otherParams: 'Updated!'})}
        />
      </View>
    );
  }
}

class ModalScreen extends Component {
  render() {
    return (
      <View style={{flex: 1, alignItems: 'center', justifyContent: 'center'}}>
        <Text style={{ fontSize: 30 }}>This is a modal!</Text>
        <Button 
          onPress={() => this.props.navigation.goBack()}
          title="Dismiss"
        />
      </View>
    );
  }
}

const MainStack = StackNavigator(
  {
    Home: {
      screen: HomeScreen
    },
    Details: {
      screen: DetailsScreen,
    },
  },
  {
    initialRouteName: 'Home',
    navigationOptions: {
      headerStyle: {
        backgroundColor: '#f4511e'
      },
      headerTintColor: '#fff',
      headerTitleStyle: {
        fontWeight: 'bold',
      },
    }
  },
);

const RootStack = StackNavigator(
  {
    Main: {
      screen: MainStack,
    },
    MyModal: {
      screen: ModalScreen,
    },
  },
  {
    mode: 'modal',
    headerMode: 'none'
  },
);

export default RootStack;

class SettingsScreen extends React.Component {
  render() {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <Text>Settings!</Text>
      </View>
    );
  }
}

const TabStack = TabNavigator(
  {
    Home: { screen: HomeScreen },
    Settings: { screen: SettingsScreen },
  }
);

// export default TabStack;
